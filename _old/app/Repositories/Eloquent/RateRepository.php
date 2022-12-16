<?php


namespace App\Repositories\Eloquent;

use App\Rate;
use App\Repositories\RateRepositoryInterface;

/**
 * Class RateRepository
 * @package App\Repositories\Eloquent
 */
class RateRepository extends RepositoryModel implements RateRepositoryInterface
{
    protected $fillable = ['currency', 'date', 'rate'];

    /**
     * RateRepository constructor.
     */
    public function __construct()
    {
        /** @var RepositoryModel model */
        $this->model = new Rate;
    }

    /**
     * @param array $data
     * @return RateRepositoryInterface
     */
    public function firstOrCreate(array $data = []): RateRepositoryInterface
    {
        parent::firstOrCreate($data);
        return $this;
    }

    /**
     * @return float
     */
    public function getRate(): float
    {
        return $this->model->rate ?? 0;
    }

    /**
     * @return string
     */
    public function getDate() : string
    {
        return $this->model->date ?? '';
    }

    /**
     * @return string
     */
    public function getCurrency() : string
    {
        return $this->model->currency ?? '';
    }

    /**
     * @param float $rate
     * @return RateRepositoryInterface
     */
    public function setRate(float $rate): RateRepositoryInterface
    {
        $this->model->rate = $rate;
        return $this;
    }

    /**
     * @param string $date
     * @return RateRepositoryInterface
     */
    public function setDate(string $date): RateRepositoryInterface
    {
        $this->model->date = $date;
        return $this;
    }

    /**
     * @param string $currency
     * @return RateRepositoryInterface
     */
    public function setCurrency(string $currency): RateRepositoryInterface
    {
        $this->model->currency = $currency;
        return $this;
    }
}
