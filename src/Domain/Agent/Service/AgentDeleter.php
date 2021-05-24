<?php


namespace App\Domain\Agent\Service;

use App\Domain\Agent\Repository\AgentRepository;

/**
 * Service
 * Class AgentDeleter
 * @package App\Domain\Agent\Service
 */
final class AgentDeleter
{
    private AgentRepository $repository;

    /**
     * AgentDeleter constructor.
     * @param AgentRepository $repository The repository
     */
    public function __construct(AgentRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Delete agent.
     *
     * @param int $agentId The agent id
     *
     * @return void
     */
    public function deleteAgent(int $agentId): void
    {
        // Input validation
        // ...

        $this->repository->deleteAgentById($agentId);
    }

}
