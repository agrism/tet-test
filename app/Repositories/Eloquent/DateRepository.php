<?php


namespace App\Repositories\Eloquent;

use App\Currency;
use App\Date;
use App\Repositories\DateRepositoryInterface;
use Carbon\Carbon;

/**
 * Class DateRepository
 * @package App\Repositories\Eloquent
 */
class DateRepository extends RepositoryModel implements DateRepositoryInterface
{
    public function __construct()
    {
        /** @var RepositoryModel model */
        $this->model = new Date;
    }

    /**
     * @param string $date
     * @return DateRepositoryInterface
     */
    public function setDate(string $date): DateRepositoryInterface
    {
        $this->model->date = $date;
        return $this;
    }

    /**
     * @param array $data
     * @return DateRepositoryInterface
     */
    public function firstOrCreate(array $data = []): DateRepositoryInterface
    {
        parent::firstOrCreate($data);
        return $this;
    }

    /**
     * @return string
     */
    public function getDate(): string
    {
        return $this->model->date ?? '';
    }

    /**
     * @param string $date
     * @return array
     */
    public function getDateRatesByDate(string $date): array
    {
        try {
            $date = Carbon::createFromFormat('Y-m-d', $date)->format('Y-m-d');
        } catch (\Exception $exception) {
            return [];
        }

        if ($date = $this->model->where('date', $date)->with('rates')->first()) {
            return $date->rates->toArray();
        }

        return [];
    }
}
