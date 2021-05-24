<?php


namespace App\Domain\File\Repository;

use App\Domain\File\Data\FileData;
use App\Factory\QueryFactory;

/**
 * Repository
 * Class FileFinderRepository
 * @package App\Domain\File\Repository
 */
final class FileFinderRepository
{
    private QueryFactory $queryFactory;

    /**
     * The constructor.
     *
     * @param QueryFactory $queryFactory The query factory
     */
    public function __construct(QueryFactory $queryFactory)
    {
        $this->queryFactory = $queryFactory;
    }

    /**
     * Find files.
     *
     * @param $taximanId
     * @return FileData[] A list of files for taximan selected
     */
    public function findFile($taximanId): array
    {
        $query = $this->queryFactory->newSelect('files');

        $query->select(
            [
                'id',
                'file_type',
                'file_path',
                'doc_classifier',
                'taximan_id',
                'expiration_date',
                'last_modified',
                'created_at'
            ]
        );

        $query->andWhere(['taximan_id' => $taximanId]);

        // Add more "use case specific" conditions to the query
        // ...

        $rows = $query->execute()->fetchAll('assoc') ?: [];

        // Convert to list of objects
        return hydrate($rows, FileData::class);
    }

}
