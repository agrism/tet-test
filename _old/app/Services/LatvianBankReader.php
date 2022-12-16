<?php


namespace App\Services;


use App\Repositories\CurrencyRepositoryInterface;
use App\Repositories\DateRepositoryInterface;
use App\Repositories\RateRepositoryInterface;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Support\Facades\App;

/**
 * Class LatvianBankReader
 * @package App\Services
 */
class LatvianBankReader implements CurrencyReaderInterface
{
    /**
     * @var array
     */
    private $importDates = [];

    private $rateRepository;
    private $dateRepository;
    private $currencyRepository;

    /**
     * LatvianBankReader constructor.
     */
    public function __construct()
    {
        $this->rateRepository = App::make(RateRepositoryInterface::class);
        $this->dateRepository = App::make(DateRepositoryInterface::class);
        $this->currencyRepository = App::make(CurrencyRepositoryInterface::class);
    }

    /**
     * @param array $dates
     * @return CurrencyReaderInterface
     */
    public function setImportDates($dates = []): CurrencyReaderInterface
    {
        $this->importDates = $dates;

        return $this;
    }

    /**
     * @param int $days
     * @return CurrencyReaderInterface
     */
    public function setImportDatesDaysBackFromToday(int $days = 1): CurrencyReaderInterface
    {
        $now = Carbon::now();
        $period = CarbonPeriod::create((clone $now)->subDays($days)->format('Y-m-d'),
            (clone $now)->format('Y-m-d'));

        foreach ($period as $date) {
            $this->importDates[] = $date->format('Y-m-d');
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function runImport(): CurrencyReaderInterface
    {
        foreach ($this->importDates as $datum) {

            if(count($this->dateRepository->getDateRatesByDate($datum))){
                continue;
            }

            $this->import($datum);
        }

        return $this;
    }

    /**
     * @param string $date
     * @return $this
     */
    private function import(string $date): self
    {
        try {
            $dateForUrl = Carbon::createFromFormat('Y-m-d', $date)->format('Ymd');
        } catch (\Exception $e) {
            return $this;
        }

        $file = config('custom.lbUrl').$dateForUrl; // url should be moved to .env file
        $xml = simplexml_load_string(file_get_contents($file), "SimpleXMLElement", LIBXML_NOCDATA);
        $json = json_encode($xml);
        $data = json_decode($json, TRUE);

        if (!$dataDate = $data['Date'] ?? null) {
            return $this;
        }

        try {
            $dataDate = Carbon::createFromFormat('Ymd', $dataDate)->format('Y-m-d');
        } catch (\Exception $exception) {
            return $this;
        }

        collect($data['Currencies']['Currency'] ?? [])->each(function ($item) use ($dataDate) {

            $this->currencyRepository->firstOrCreate(['currency' => $item['ID']]);
            $this->dateRepository->firstOrCreate(['date' => $dataDate]);

            $rateRepository = $this->rateRepository->firstOrCreate([
                'date' => $this->dateRepository->getDate(),
                'currency' => $this->currencyRepository->getCurrency(),
            ]);

            if (!$rateRepository->getRate()) {

                $rateRepository->setRate((float)$item['Rate']);

                try {
                    $rateRepository->save();
                } catch (\Exception $exception) {
                    print $exception->getMessage() . PHP_EOL;
                }
            }
        });

        return $this;
    }
}
