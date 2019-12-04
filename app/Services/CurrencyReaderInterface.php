<?php


namespace App\Services;

/**
 * Interface CurrencyReaderInterface
 * @package App\Services
 */
interface CurrencyReaderInterface
{
    /**
     * @param array $dates
     * @return $this
     */
    public function setImportDates($dates = []): self;

    /**
     * @param int $days
     * @return $this
     */
    public function setImportDatesDaysBackFromToday(int $days = 1): self;

    /**
     * @return $this
     */
    public function runImport(): self;
}
