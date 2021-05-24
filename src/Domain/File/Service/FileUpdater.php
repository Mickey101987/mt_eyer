<?php


namespace App\Domain\File\Service;

use App\Domain\File\Data\FileData;
use App\Domain\File\Repository\FileRepository;
use App\Factory\LoggerFactory;
use Psr\Log\LoggerInterface;

/**
 * Class FileUpdater
 * @package App\Domain\File\Service
 */
final class FileUpdater
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
            ->addFileHandler('file_updater.log')
            ->createLogger();
    }

    /**
     * Update file.
     *
     * @param int $fileId The file id
     * @param array<mixed> $data The request data
     *
     * @return void
     */
    public function updateFile(int $fileId, array $data): void
    {
        // Input validation
        $this->fileValidator->validateFileUpdate($fileId, $data);

        // Validation was successfully
        $file = new FileData($data);
        $file->id = $fileId;

        // Update the file
        $this->repository->updateFile($file);

        // Logging
        $this->logger->info(sprintf('File updated successfully: %s', $fileId));
    }

}
