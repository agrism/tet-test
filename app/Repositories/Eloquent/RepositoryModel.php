<?php


namespace App\Repositories\Eloquent;

use App\Http\Controllers\RateController;
use App\Rate;
use Carbon\Carbon;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Class RepositoryModel
 * @package App\Repositories\Eloquent
 */
class RepositoryModel
{
    /**
     * @var RepositoryModel Currency
     */
    protected $model;

    protected $fillable = [];

    protected $filters = [];

    public function all()
    {
        return $this->model->all();
    }

    public function with($relations)
    {
        return $this->model->with($relations);
    }

    /**
     * @param string $key
     * @param string $value
     * @param string $keySort
     * @return array
     */
    public function getOptions(string $key, string $value, string $keySort = 'asc'): array
    {
        $keySort = $keySort == 'desc' ? $keySort : 'asc';

        return array_merge(['' => '-'],
            $this->model
                ->orderBy($key, $keySort)
                ->pluck($key, $value)->toArray());
    }

    public function firstOrCreate(array $data = [])
    {
        $this->model = $this->model->firstOrCreate($data);

        return $this;
    }

    public function save()
    {
        $this->model->save();
    }

    /**
     * @return $this
     */
    public function setFilters(array $filters = []): self
    {
        foreach ($filters as $key => $value) {
            $this->filters[$key] = $value;
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function createQuery(): self
    {
        $this->model = $this->model->query();

        return $this;
    }

    /**
     * @param string $col
     * @param string $direction
     * @return $this
     */
    public function setOrder(string $col, string $direction = 'asc'): self
    {
        $direction = $direction == 'desc' ? 'desc' : 'asc';

        $this->model->orderBy($col, $direction);

        return $this;
    }

    /**
     * @return $this
     */
    public function applyFilters(): self
    {
        foreach ($this->filters as $key => $value) {

            if (in_array($key, $this->fillable) && $value) {
                $this->model->where($key, $value);
            }
        }

        return $this;
    }

    /**
     * @return LengthAwarePaginator
     */
    public function paging($perPage = 10, $currentPage = 1): LengthAwarePaginator
    {
        $return = $this->model->paginate($perPage);

        if ($return->lastPage() < $currentPage) {
            $return = $this->model->paginate($perPage, ['*'], 'page', $return->lastPage());
        }

        return $return;
    }

}
