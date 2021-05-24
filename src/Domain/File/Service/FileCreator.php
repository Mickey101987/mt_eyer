<?php


namespace App\Domain\File\Service;

use App\Domain\File\Data\FileData;
use App\Domain\File\Repository\FileRepository;
use App\Factory\LoggerFactory;
use Psr\Log\LoggerInterface;

/**
 * Class FileCreator
 * @package App\Domain\File\Service
 */
final class FileCreator
{
    private FileRepository $repository;

    private FileValidator $fileValidator;

    private LoggerInterface $logger;

    /**
     * The constructor.
     *
     * @param FileRepository $repository The repository
     * @param FileValidator $fileValidator The validator
     * @param LoggerFactory $loggerFactory The logger factory
     */
    public function __construct(
        FileRepository $repository,
        FileValidator $fileValidator,
        LoggerFactory $loggerFactory
    ) {
        $this->repository = $repository;
        $this->fileValidator = $fileValidator;
        $this->logger = $loggerFactory
            ->addFileHandler('file_creator.log')
            ->createLogger();
    }

    /**
     * Create a new file.
     *
     * @param array<mixed> $data The form data
     *
     * @return int The new file ID
     */
    public function createFile(array $data): int
    {
        // Input validation
        $this->fileValidator->validateFile($data);

        // Map form data to file DTO (model)
        $file = new FileData($data);

        // Insert file and get new file ID
        $fileId = $this->repository->insertFile($file);

        // Logging
        $this->logger->info(sprintf('File created successfully: %s', $fileId));

        return $fileId;
    }

}
