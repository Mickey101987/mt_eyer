<?php


namespace App\Domain\File\Service;

use App\Domain\File\Repository\FileRepository;

/**
 * Service
 * Class FileDeleter
 * @package App\Domain\File\Service
 */
final class FileDeleter
{
    private FileRepository $repository;

    /**
     * FileDeleter constructor.
     * @param FileRepository $repository The repository
     */
    public function __construct(FileRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Delete file.
     *
     * @param int $fileId The file id
     *
     * @return void
     */
    public function deleteFile(int $fileId): void
    {
        // Input validation
        // ...

        $this->repository->deleteFileById($fileId);
    }

}
