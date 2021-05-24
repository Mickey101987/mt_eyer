<?php

namespace App\Domain\Taximan\Service;

use App\Domain\Taximan\Data\TaximanData;
use App\Domain\Taximan\Repository\TaximanFinderRepository;

/**
 * Service
 * Class TaximanFinder
 * @package App\Domain\Taximan\Service
 */
final class TaximanFinder
{
    private TaximanFinderRepository $repository;

    /**
     * TaximanFinder constructor.
     * @param TaximanFinderRepository $repository The repository
     */
    public function __construct(TaximanFinderRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Find taximen.
     *
     * @param int|null $agentId
     * @return TaximanData[] A list of taximem
     */
    public function findTaximan(int $agentId = null): array
    {
        // Input validation
        // ...

        return $this->repository->findTaximan($agentId);
    }
}
