<?php


namespace App\Domain\Commune\Service;

use App\Domain\Commune\Repository\CommuneRepository;
use App\Factory\ValidationFactory;
use Cake\Validation\Validator;
use Selective\Validation\Exception\ValidationException;

/**
 * Validator
 * Class CommuneValidator
 * @package App\Domain\Commune\Service
 */
final class CommuneValidator
{
    private CommuneRepository $repository;

    private ValidationFactory $validationFactory;

    /**
     * CommuneValidator constructor.
     * @param CommuneRepository $repository Th repository
     * @param ValidationFactory $validationFactory The validator
     */
    public function __construct(CommuneRepository $repository, ValidationFactory $validationFactory)
    {
        $this->repository = $repository;
        $this->validationFactory = $validationFactory;
    }

    /**
     * Validate update.
     *
     * @param int $communeId The commune id
     * @param array<mixed> $data The data
     *
     * @return void
     */
    public function validateCommuneUpdate(int $communeId, array $data): void
    {
        if (!$this->repository->existsCommuneId($communeId)) {
            throw new ValidationException(sprintf('Commune not found: %s', $communeId));
        }

        $this->validateCommune($data);
    }

    /**
     * Validate new commune.
     *
     * @param array<mixed> $data The data
     *
     * @throws ValidationException
     *
     * @return void
     */
    public function validateCommune(array $data): void
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
            ->notEmptyString('name', 'Input required')
            ->notEmptyString('type', 'Input required')
            ->notEmptyString('region', 'Input required')
            ->notEmptyString('department', 'Input required');
    }

}
