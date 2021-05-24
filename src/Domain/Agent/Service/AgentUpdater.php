<?php


namespace App\Domain\Agent\Service;

use App\Domain\Agent\Data\AgentData;
use App\Domain\Agent\Repository\AgentRepository;
use App\Factory\LoggerFactory;
use Psr\Log\LoggerInterface;

/**
 * service
 * Class AgentUpdater
 * @package App\Domain\Agent\Service
 */
final class AgentUpdater
{
    private AgentRepository $repository;

    private AgentValidator $agentValidator;

    private LoggerInterface $logger;

    /**
     * The constructor.
     *
     * @param AgentRepository $repository The repository
     * @param AgentValidator $agentValidator The validator
     * @param LoggerFactory $loggerFactory The logger factory
     */
    public function __construct(
        AgentRepository $repository,
        AgentValidator $agentValidator,
        LoggerFactory $loggerFactory
    ) {
        $this->repository = $repository;
        $this->agentValidator = $agentValidator;
        $this->logger = $loggerFactory
            ->addFileHandler('agent_updater.log')
            ->createLogger();
    }

    /**
     * Update agent.
     *
     * @param int $agentId The agent id
     * @param array<mixed> $data The request data
     *
     * @return void
     */
    public function updateAgent(int $agentId, array $data): void
    {
        // Input validation
        $this->agentValidator->validateAgentUpdate($agentId, $data);

        // Validation was successfully
        $agent = new AgentData($data);
        $agent->id = $agentId;

        // Update the agent
        $this->repository->updateAgent($agent);

        // Logging
        $this->logger->info(sprintf('Agent updated successfully: %s', $agentId));
    }

}
