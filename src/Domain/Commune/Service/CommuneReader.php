<?php


namespace App\Domain\Commune\Service;

use App\Domain\Commune\Data\CommuneData;
use App\Domain\Commune\Repository\CommuneRepository;

/**
 * Service
 * Class CommuneReader
 * @package App\Domain\Commune\Service
 */
final class CommuneReader
{
    private CommuneRepository $repository;

    /**
     * CommuneReader constructor.
     * @param CommuneRepository $repository The repository
     */
    public function __construct(CommuneRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Read a commune.
     *
     * @param int $communeId The commune id
     *
     * @return CommuneData The commune data
     */
    public function getCommuneData(int $communeId): CommuneData
    {
        // Input validation
        // ...

        // Fetch data from the database
        $commune = $this->repository->getCommuneById($communeId);

        // Optional: Add or invoke your complex business logic here
        // ...

        // Optional: Map result
        // ...

        return $commune;
    }

}
