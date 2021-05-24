<?php


namespace App\Domain\File\Data;

use Selective\ArrayReader\ArrayReader;

/**
 * Data model
 * Class FileData
 * @package App\Domain\File\Data
 */
final class FileData
{
    public ?int $id = null;
    public ?int $taximanId = null;
    public ?string $fileType = null;
    public ?string $filePath = null;
    public ?string $docClassifier = null;
    public ?string $expirationDate = null;
    public ?string $lastModified = null;
    public ?string $createdAt = null;

    public function __construct(array $data = [])
    {
        $reader = new ArrayReader($data);

        $this->id = $reader->findInt('id');
        $this->taximanId = $reader->findInt('taximan_id');
        $this->fileType = $reader->findString('file_type');
        $this->filePath = $reader->findString('file_path');
        $this->docClassifier = $reader->findString('doc_classifier');
        $this->expirationDate = $reader->findChronos('expiration_date');
        $this->lastModified = $reader->findChronos('last_modified');
        $this->createdAt = $reader->findChronos('created_at');
    }

}
