<?php


namespace App\Repositories\Eloquent;

use App\Currency;
use App\Repositories\CurrencyRepositoryInterface;

/**
 * Class CurrencyRepository
 * @package App\Repositories\Eloquent
 */
class CurrencyRepository extends RepositoryModel implements CurrencyRepositoryInterface
{
    /**
     * CurrencyRepository constructor.
     */
    public function __construct()
    {
        /** @var RepositoryModel model */
        $this->model = new Currency;
    }

    /**
     * @param array $data
     * @return CurrencyRepositoryInterface
     */
    public function firstOrCreate(array $data = []): CurrencyRepositoryInterface
    {
        parent::firstOrCreate($data);
        return $this;
    }

    /**
     * @param string $currency
     * @return CurrencyRepositoryInterface
     */
    public function setCurrency(string $currency): CurrencyRepositoryInterface
    {
        $this->model->currency = $currency;
        return $this;
    }

    /**
     * @return string
     */
    public function getCurrency(): string
    {
        return $this->model->currency ?? '';
    }
}
