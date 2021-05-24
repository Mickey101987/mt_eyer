<?php


namespace App\Domain\Commune\Service;

use App\Domain\Commune\Data\CommuneData;
use App\Domain\Commune\Repository\CommuneFinderRepository;

/**
 * Service
 * Class CommuneFinder
 * @package App\Domain\Commune\Service
 */
final class CommuneFinder
{
    private CommuneFinderRepository $repository;

    /**
     * CommuneFinder constructor.
     * @param CommuneFinderRepository $repository The repository
     */
    public function __construct(CommuneFinderRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Find taximen.
     *
     * @return CommuneData[] A list of communes
     */
    public function findCommune(): array
    {
        // Input validation
        // ...

        return $this->repository->findCommune();
    }

}
