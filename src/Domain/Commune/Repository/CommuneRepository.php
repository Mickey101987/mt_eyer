<?php


namespace App\Domain\Commune\Repository;

use App\Domain\Commune\Data\CommuneData;
use App\Factory\QueryFactory;
use Cake\Chronos\Chronos;
use DomainException;

/**
 * Repository
 * Class CommuneRepository
 * @package App\Domain\Commune\Repository
 */
final class CommuneRepository
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
     * Insert commune row.
     *
     * @param CommuneData $commune The commune data
     *
     * @return int The new ID
     */
    public function insertCommune(CommuneData $commune): int
    {
        $row = $this->toRow($commune);
        $row['last_modified'] = Chronos::now()->toDateTimeString();
        $row['created_at'] = Chronos::now()->toDateTimeString();

        return (int)$this->queryFactory->newInsert('communes', $row)
            ->execute()
            ->lastInsertId();
    }

    /**
     * Get commune by id.
     *
     * @param int $communeId The commune id
     *
     * @throws DomainException
     *
     * @return CommuneData The commune
     */
    public function getCommuneById(int $communeId): CommuneData
    {
        $query = $this->queryFactory->newSelect('communes');
        $query->select(
            [
                'id',
                'name',
                'type',
                'region',
                'department',
                'population',
                'logo',
                'description',
                'last_modified',
                'created_at'
            ]
        );

        $query->andWhere(['id' => $communeId]);

        $row = $query->execute()->fetch('assoc');

        if (!$row) {
            throw new DomainException(sprintf('Commune not found: %s', $communeId));
        }

        return new CommuneData($row);
    }

    /**
     * Update commune row.
     *
     * @param CommuneData $commune The commune
     *
     * @return void
     */
    public function updateCommune(CommuneData $commune): void
    {
        $row = $this->toRow($commune);
        unset($row['created_at']);
        
        $row['last_modified'] = Chronos::now()->toDateTimeString();

        $this->queryFactory->newUpdate('communes', $row)
            ->andWhere(['id' => $commune->id])
            ->execute();
    }

    /**
     * Check commune id.
     *
     * @param int $communeId The commune id
     *
     * @return bool True if exists
     */
    public function existsCommuneId(int $communeId): bool
    {
        $query = $this->queryFactory->newSelect('communes');
        $query->select('id')->andWhere(['id' => $communeId]);

        return (bool)$query->execute()->fetch('assoc');
    }

    /**
     * Delete commune row.
     *
     * @param int $communeId The commune id
     *
     * @return void
     */
    public function deleteCommuneById(int $communeId): void
    {
        $this->queryFactory->newDelete('communes')
            ->andWhere(['id' => $communeId])
            ->execute();
    }

    /**
     * Convert to array.
     *
     * @param CommuneData $commune The commune data
     *
     * @return array The array
     */
    private function toRow(CommuneData $commune): array
    {
        return [
            'id' => $commune->id,
            'name' => $commune->name,
            'type' => $commune->type,
            'region' => $commune->region,
            'department' => $commune->department,
            'population' => $commune->population,
            'logo' => $commune->logo,
            'description' => $commune->description
        ];
    }

}
