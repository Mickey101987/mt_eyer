<?php

namespace App\Domain\Taximan\Service;

use App\Domain\Taximan\Repository\TaximanRepository;

/**
 * Service
 * Class TaximanDeleter
 * @package App\Domain\Taximan\Service
 */
final class TaximanDeleter
{
    private TaximanRepository $repository;

    /**
     * TaximanDeleter constructor.
     * @param TaximanRepository $repository The repository
     */
    public function __construct(TaximanRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Delete taximan.
     *
     * @param int $taximanId The taximan id
     *
     * @return void
     */
    public function deleteTaximan(int $taximanId): void
    {
        // Input validation
        // ...

        $this->repository->deleteTaximanById($taximanId);
    }
}
