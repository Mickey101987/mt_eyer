<?php


namespace App\Domain\File\Service;

use App\Domain\File\Data\FileData;
use App\Domain\File\Repository\FileFinderRepository;

class FileFinder
{
    private FileFinderRepository $repository;

    /**
     * FileFinder constructor.
     * @param FileFinderRepository $repository The repository
     */
    public function __construct(FileFinderRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Find taximen.
     *
     * @param int|null $taximanId
     * @return FileData[] A list of files
     */
    public function findFile(int $taximanId = null): array
    {
        // Input validation
        // ...

        return $this->repository->findFile($taximanId);
    }

}
