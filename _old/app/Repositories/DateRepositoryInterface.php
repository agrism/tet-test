<?php


namespace App\Repositories;


interface DateRepositoryInterface
{
    public function all();

    public function getOptions(string $key, string $value, string $keySort = 'asc'): array;

    public function with($relations);

    /**
     * @param array $data
     * @return $this
     */
    public function firstOrCreate(array $data = []): self;

    /**
     * @return string
     */
    public function getDate(): string;

    /**
     * @param string $date
     * @return $this
     */
    public function setDate(string $date): self;

    /**
     * @param string $date
     * @return array
     */
    public function getDateRatesByDate(string $date): array;
}
