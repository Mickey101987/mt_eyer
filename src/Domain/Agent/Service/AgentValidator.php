<?php


namespace App\Domain\Agent\Service;

use App\Domain\Agent\Repository\AgentRepository;
use App\Factory\ValidationFactory;
use Cake\Validation\Validator;
use Selective\Validation\Exception\ValidationException;

/**
 * Validator
 * Class AgentValidator
 * @package App\Domain\Agent\Service
 */
final class AgentValidator
{
    private AgentRepository $repository;

    private ValidationFactory $validationFactory;

    /**
     * AgentValidator constructor.
     * @param AgentRepository $repository Th repository
     * @param ValidationFactory $validationFactory The validator
     */
    public function __construct(AgentRepository $repository, ValidationFactory $validationFactory)
    {
        $this->repository = $repository;
        $this->validationFactory = $validationFactory;
    }

    /**
     * Validate update.
     *
     * @param int $agentId The agent id
     * @param array<mixed> $data The data
     *
     * @return void
     */
    public function validateAgentUpdate(int $agentId, array $data): void
    {
        if (!$this->repository->existsAgentId($agentId)) {
            throw new ValidationException(sprintf('Agent not found: %s', $agentId));
        }

        $this->validateAgent($data);
    }

    /**
     * Validate new agent.
     *
     * @param array<mixed> $data The data
     *
     * @throws ValidationException
     *
     * @return void
     */
    public function validateAgent(array $data): void
    {
        $validator = $this->createValidator();

        $validationResult = $this->validationFactory->createValidationResult(
            $validator->validate($data)
        );

        if ($validationResult->fails()) {
            throw new ValidationException('Please check your input', $validationResult);
        }
    }

    /**
     * Create validator.
     *
     * @return Validator The validator
     */
    private function createValidator(): Validator
    {
        $validator = $this->validationFactory->createValidator();

        return $validator
            ->notEmptyString('id', 'Input required')
            ->notEmptyString('full_name', 'Input required')
            ->notEmptyString('matricule_number', 'Input required')
            ->notEmptyString('username', 'Input required')
            ->notEmptyString('password', 'Input required')
            ->minLength('password', 8, 'Too short')
            ->maxLength('password', 40, 'Too long')
            ->notEmptyString('user_id', 'Input required');

    }

}
