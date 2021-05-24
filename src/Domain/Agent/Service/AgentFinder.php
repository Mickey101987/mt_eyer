<?php


namespace App\Domain\Agent\Service;

use App\Domain\Agent\Data\AgentData;
use App\Domain\Agent\Repository\AgentFinderRepository;

/**
 * Service
 * Class AgentFinder
 * @package App\Domain\Agent\Service
 */
final class AgentFinder
{
    private AgentFinderRepository $repository;

    /**
     * AgentFinder constructor.
     * @param AgentFinderRepository $repository The repository
     */
    public function __construct(AgentFinderRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Find taximen.
     *
     * @return AgentData[] A list of agents
     */
    public function findAgent(): array
    {
        // Input validation
        // ...

        return $this->repository->findAgent();
    }

}
