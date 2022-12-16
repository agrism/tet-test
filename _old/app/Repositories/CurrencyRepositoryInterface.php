<?php


namespace App\Repositories;


interface CurrencyRepositoryInterface
{
    public function all();

    public function getOptions(string $key, string $value, string $keySort = 'asc'): array;

    public function with($relations);

    /**
     * @param array $data
     * @return CurrencyRepositoryInterface
     */
    public function firstOrCreate(array $data = []) : self;

    public function getCurrency() : string;

    public function setCurrency(string $currency) : self;
}
