<?php


namespace App\Domain\Agent\Service;

use App\Domain\Agent\Data\AgentData;
use App\Domain\Agent\Repository\AgentRepository;
use App\Factory\LoggerFactory;
use Psr\Log\LoggerInterface;

/**
 * Class AgentCreator
 * @package App\Domain\Agent\Service
 */
final class AgentCreator
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
            ->addFileHandler('agent_creator.log')
            ->createLogger();
    }

    /**
     * Create a new agent.
     *
     * @param array<mixed> $data The form data
     *
     * @return int The new agent ID
     */
    public function createAgent(array $data): int
    {
        // Input validation
        $this->agentValidator->validateAgent($data);

        // Map form data to agent DTO (model)
        $agent = new AgentData($data);

        // Hash password
        if ($agent->password) {
            $agent->password = (string)password_hash($agent->password, PASSWORD_DEFAULT);
        }

        // Insert agent and get new agent ID
        $agentId = $this->repository->insertAgent($agent);

        // Logging
        $this->logger->info(sprintf('Agent created successfully: %s', $agentId));

        return $agentId;
    }

}
