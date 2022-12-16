<?php


namespace App\Repositories;


interface RateRepositoryInterface
{
    public function all();

    public function getOptions(string $key, string $value, string $keySort = 'asc'): array;

//    public function with($relations);

    /**
     * @param array $data
     * @return $this
     */
    public function firstOrCreate(array $data = []): self;

    /**
     * @param string $date
     * @return $this
     */
    public function setDate(string $date): self;

    /**
     * @param string $currency
     * @return $this
     */
    public function setCurrency(string $currency): self;

    /**
     * @param float $rate
     * @return $this
     */
    public function setRate(float $rate): self;

    /**
     * @return string
     */
    public function getDate(): string;

    /**
     * @return string
     */
    public function getCurrency(): string;

    /**
     * @return float
     */
    public function getRate() : float;
}
