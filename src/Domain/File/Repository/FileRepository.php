<?php


namespace App\Domain\File\Repository;

use App\Domain\File\Data\FileData;
use App\Factory\QueryFactory;
use Cake\Chronos\Chronos;
use DomainException;

/**
 * Repository
 * Class FileRepository
 * @package App\Domain\File\Repository
 */
final class FileRepository
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
     * Insert file row.
     *
     * @param FileData $file The file data
     *
     * @return int The new ID
     */
    public function insertFile(FileData $file): int
    {
        $row = $this->toRow($file);
        $row['last_modified'] = Chronos::now()->toDateTimeString();
        $row['created_at'] = Chronos::now()->toDateTimeString();

        return (int)$this->queryFactory->newInsert('files', $row)
            ->execute()
            ->lastInsertId();
    }

    /**
     * Get file by id.
     *
     * @param int $fileId The file id
     *
     * @throws DomainException
     *
     * @return FileData The file
     */
    public function getFileById(int $fileId): FileData
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

        $query->andWhere(['id' => $fileId]);

        $row = $query->execute()->fetch('assoc');

        if (!$row) {
            throw new DomainException(sprintf('File not found: %s', $fileId));
        }

        return new FileData($row);
    }

    /**
     * Update file row.
     *
     * @param FileData $file The file
     *
     * @return void
     */
    public function updateFile(FileData $file): void
    {
        $row = $this->toRow($file);

        $row['last_modified'] = Chronos::now()->toDateTimeString();

        $this->queryFactory->newUpdate('files', $row)
            ->andWhere(['id' => $file->id])
            ->execute();
    }

    /**
     * Check file id.
     *
     * @param int $fileId The file id
     *
     * @return bool True if exists
     */
    public function existsFileId(int $fileId): bool
    {
        $query = $this->queryFactory->newSelect('files');
        $query->select('id')->andWhere(['id' => $fileId]);

        return (bool)$query->execute()->fetch('assoc');
    }

    /**
     * Delete file row.
     *
     * @param int $fileId The file id
     *
     * @return void
     */
    public function deleteFileById(int $fileId): void
    {
        $this->queryFactory->newDelete('files')
            ->andWhere(['id' => $fileId])
            ->execute();
    }

    /**
     * Convert to array.
     *
     * @param FileData $file The file data
     *
     * @return array The array
     */
    private function toRow(FileData $file): array
    {
        return [
            'id' => $file->id,
            'file_type' => $file->fileType,
            'file_path' => $file->filePath,
            'doc_classifier' => $file->docClassifier,
            'taximan_id' => $file->taximanId,
            'expiration_date' => Chronos::createFromDate($file->expirationDate)
        ];
    }

}
