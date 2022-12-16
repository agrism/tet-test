<?php

namespace App\Console\Commands;

use App\Services\LatvianBankReader;
use App\Services\CurrencyReaderInterface;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\App;

class ReadCurrencies extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'currency:read {--date=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Read currencies';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        try{
            $service = App::make(CurrencyReaderInterface::class);
            /** @var CurrencyReaderInterface $service */
            if($date = $this->option('date')){
                $service->setImportDates([$date]);
            }

            $service->setImportDatesDaysBackFromToday(5)
                ->runImport();

        } catch(\Exception $exception){
            print $exception->getMessage().PHP_EOL;
        }

        print "Done: ".Carbon::now()->format('Y-m-d H:i:s').' command: '.$this->signature.PHP_EOL;
    }
}
