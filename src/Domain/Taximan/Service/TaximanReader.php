<?php

namespace App\Domain\Taximan\Service;

use App\Domain\Taximan\Data\TaximanData;
use App\Domain\Taximan\Repository\TaximanRepository;

/**
 * Service
 * Class TaximanReader
 * @package App\Domain\Taximan\Service
 */
final class TaximanReader
{
    private TaximanRepository $repository;

    /**
     * TaximanReader constructor.
     * @param TaximanRepository $repository The repository
     */
    public function __construct(TaximanRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Read a taximan.
     *
     * @param int $taximanId The taximan id
     *
     * @return TaximanData The taximan data
     */
    public function getTaximanData(int $taximanId): TaximanData
    {
        // Input validation
        // ...

        // Fetch data from the database
        $taximan = $this->repository->getTaximanById($taximanId);

        // Optional: Add or invoke your complex business logic here
        // ...

        // Optional: Map result
        // ...

        return $taximan;
    }
}
