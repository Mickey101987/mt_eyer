<?php


namespace App\Domain\Agent\Data;

use Selective\ArrayReader\ArrayReader;

/**
 * Data Model
 * Class AgentData
 * @package App\Domain\Agent\Data
 */
final class AgentData
{
    public ?int $id = null;
    public ?int $communeId = null;
    public ?int $adminId = null;
    public ?string $matriculeNumber = null;
    public ?string $fullName = null;
    public ?string $username = null;
    public ?string $password = null;
    public ?string $status = null;
    public ?string $lastModified = null;
    public ?string $createdAt = null;

    /**
     * AgentData constructor.
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        $reader = new ArrayReader($data);

        $this->id = $reader->findInt('id');
        $this->communeId = $reader->findInt('commune_id');
        $this->adminId = $reader->findInt('user_id');
        $this->matriculeNumber = $reader->findString('matricule_number');
        $this->fullName = $reader->findString('full_name');
        $this->username = $reader->findString('username');
        $this->password = $reader->findString('password');
        $this->status = $reader->findString('status');
        $this->lastModified = $reader->findChronos('last_modified');
        $this->createdAt = $reader->findChronos('created_at');
    }
}
