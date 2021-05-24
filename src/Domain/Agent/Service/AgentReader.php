<?php


namespace App\Domain\Agent\Service;

use App\Domain\Agent\Data\AgentData;
use App\Domain\Agent\Repository\AgentRepository;

final class AgentReader
{
    private AgentRepository $repository;

    /**
     * AgentReader constructor.
     * @param AgentRepository $repository The repository
     */
    public function __construct(AgentRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Read a agent.
     *
     * @param int $agentId The agent id
     *
     * @return AgentData The agent data
     */
    public function getAgentData(int $agentId): AgentData
    {
        // Input validation
        // ...

        // Fetch data from the database
        $agent = $this->repository->getAgentById($agentId);

        // Optional: Add or invoke your complex business logic here
        // ...

        // Optional: Map result
        // ...

        return $agent;
    }

}
