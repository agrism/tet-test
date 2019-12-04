<?php

namespace App\Providers;

use App\Repositories\CurrencyRepositoryInterface;
use App\Repositories\DateRepositoryInterface;
use App\Repositories\Eloquent\CurrencyRepository;
use App\Repositories\Eloquent\DateRepository;
use App\Repositories\Eloquent\RateRepository;
use App\Repositories\RateRepositoryInterface;
use App\Services\LatvianBankReader;
use App\Services\CurrencyReaderInterface;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(CurrencyReaderInterface::class, LatvianBankReader::class);
        $this->app->bind(CurrencyRepositoryInterface::class, CurrencyRepository::class);
        $this->app->bind(DateRepositoryInterface::class, DateRepository::class);
        $this->app->bind(RateRepositoryInterface::class, RateRepository::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
    }
}
