<?php


namespace App\Domain\File\Service;

use App\Domain\File\Data\FileData;
use App\Domain\File\Repository\FileRepository;

/**
 * Service
 * Class FileReader
 * @package App\Domain\File\Service
 */
final class FileReader
{
    private FileRepository $repository;

    /**
     * FileReader constructor.
     * @param FileRepository $repository The repository
     */
    public function __construct(FileRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Read a file.
     *
     * @param int $fileId The file id
     *
     * @return FileData The file data
     */
    public function getFileData(int $fileId): FileData
    {
        // Input validation
        // ...

        // Fetch data from the database
        $file = $this->repository->getFileById($fileId);

        // Optional: Add or invoke your complex business logic here
        // ...

        // Optional: Map result
        // ...

        return $file;
    }

}
