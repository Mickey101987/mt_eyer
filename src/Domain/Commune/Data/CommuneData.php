<?php


namespace App\Domain\Commune\Data;

use Selective\ArrayReader\ArrayReader;

final class CommuneData
{
    public ?int $id = null;
    public ?string $name = null;
    public ?string $type = null;
    public ?string $region = null;
    public ?string $department = null;
    public ?int $population = null;
    public ?string $logo = null;
    public ?string $description = null;
    public ?string $lastModified = null;
    public ?string $createdAt = null;

    public function __construct(array $data = [])
    {
        $reader = new ArrayReader($data);

        $this->id = $reader->findInt('id');
        $this->name = $reader->findString('name');
        $this->type = $reader->findString('type');
        $this->region = $reader->findString('region');
        $this->department = $reader->findString('department');
        $this->population = $reader->findInt('population');
        $this->logo = $reader->findString('logo');
        $this->description = $reader->findString('description');
        $this->lastModified = $reader->findString('last_modified');
        $this->createdAt = $reader->findString('created_at');
    }

}
