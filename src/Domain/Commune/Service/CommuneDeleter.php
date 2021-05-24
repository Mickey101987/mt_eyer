<?php


namespace App\Domain\Commune\Service;

use App\Domain\Commune\Repository\CommuneRepository;

/**
 * Service
 * Class CommuneDeleter
 * @package App\Domain\Commune\Service
 */
final class CommuneDeleter
{
    private CommuneRepository $repository;

    /**
     * CommuneDeleter constructor.
     * @param CommuneRepository $repository The repository
     */
    public function __construct(CommuneRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Delete commune.
     *
     * @param int $communeId The commune id
     *
     * @return void
     */
    public function deleteCommune(int $communeId): void
    {
        // Input validation
        // ...

        $this->repository->deleteCommuneById($communeId);
    }

}
