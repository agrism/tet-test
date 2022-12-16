<?php

namespace App\Http\Controllers;

use App\Repositories\CurrencyRepositoryInterface;
use App\Repositories\DateRepositoryInterface;
use App\Repositories\RateRepositoryInterface;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;
use Illuminate\Http\Request;

class RateController extends Controller
{
    /**
     * @var int
     */
    private $perPage;

    /**
     * @var CurrencyRepositoryInterface
     */
    private $currency;

    /**
     * @var DateRepositoryInterface
     */
    private $date;

    /**
     * @var RateRepositoryInterface
     */
    private $rate;

    /** @var Request */
    private $request;

    /**
     * RateController constructor.
     * @param CurrencyRepositoryInterface $currency
     * @param DateRepositoryInterface $date
     * @param RateRepositoryInterface $rate
     */
    public function __construct(CurrencyRepositoryInterface $currency,
                                DateRepositoryInterface $date,
                                RateRepositoryInterface $rate,
                                Request $request)
    {
        $this->currency = $currency;
        $this->date = $date;
        $this->rate = $rate;
        $this->request = $request;
        $this->perPage = config('custom.perPage');
    }

    /**
     * @return Factory|View
     */
    public function __invoke()
    {
        $this->prepareFilters();

        $currencies = $this->currency->getOptions('currency', 'currency');
        $dates = $this->date->getOptions('date', 'date', 'desc');

        $rates = $this->rate
            ->createQuery()
            ->setFilters($this->getFilters(['date' => $dates, 'currency' => $currencies]))
            ->applyFilters()
            ->setOrder('date', 'desc')
            ->paging($this->perPage, $this->request->get('page'));

        return view('rates', compact('rates', 'currencies', 'dates'));
    }

    /**
     * @return $this
     */
    private function prepareFilters(): self
    {
        foreach ($this->request->all('date', 'currency') as $key => $value) {

            if ($this->request->has('page')) {
                continue;
            }

            if ($this->request->has($key) && !$value) {
                $this->request->session()->forget($key);
                continue;
            }

            $this->request->session()->put($key, $value);
        }

        return $this;
    }

    /**
     * @param string $key
     * @param array $options
     * @return string
     */
    private function getCleanedFilters(string $key, array $options): string
    {
        if (!in_array($this->request->session()->get($key), $options)) {
            $this->request->session()->forget($key);
        }

        return $this->request->session()->get($key) ?? '';
    }

    /**
     * @param array $payload
     * @return array
     */
    private function getFilters(array $payload = []): array
    {
        $return = [];

        foreach ($payload as $key => $options) {
            $return[$key] = $this->getCleanedFilters($key, (array)$options);
        }

        return $return;
    }
}
