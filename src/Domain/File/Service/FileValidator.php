<?php


namespace App\Domain\File\Service;

use App\Domain\File\Repository\FileRepository;
use App\Factory\ValidationFactory;
use Cake\Validation\Validator;
use Selective\Validation\Exception\ValidationException;

final class FileValidator
{
    private FileRepository $repository;

    private ValidationFactory $validationFactory;

    /**
     * FileValidator constructor.
     * @param FileRepository $repository Th repository
     * @param ValidationFactory $validationFactory The validator
     */
    public function __construct(FileRepository $repository, ValidationFactory $validationFactory)
    {
        $this->repository = $repository;
        $this->validationFactory = $validationFactory;
    }

    /**
     * Validate update.
     *
     * @param int $fileId The file id
     * @param array<mixed> $data The data
     *
     * @return void
     */
    public function validateFileUpdate(int $fileId, array $data): void
    {
        if (!$this->repository->existsFileId($fileId)) {
            throw new ValidationException(sprintf('File not found: %s', $fileId));
        }

        $this->validateFile($data);
    }

    /**
     * Validate new file.
     *
     * @param array<mixed> $data The data
     *
     * @throws ValidationException
     *
     * @return void
     */
    public function validateFile(array $data): void
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
            ->notEmptyString('file_type', 'Input required')
            ->notEmptyString('file_path', 'Input required')
            ->notEmptyString('doc_classifier', 'Input required')
            ->notEmptyString('taximan_id', 'Input required');
    }

}
