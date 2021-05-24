<?php


namespace App\Domain\Taximan\Repository;

use App\Domain\Taximan\Data\TaximanData;
use App\Factory\QueryFactory;
use Cake\Chronos\Chronos;
use DomainException;

/**
 * Class TaximanRepository
 * @package App\Domain\Taximan\Repository
 */
final class TaximanRepository
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
     * Insert taximan row.
     *
     * @param TaximanData $taximan The taximan data
     *
     * @return int The new ID
     */
    public function insertTaximan(TaximanData $taximan): int
    {
        $row = $this->toRow($taximan);
        $row['identification_date'] = Chronos::now()->toDateTimeString();

        return (int)$this->queryFactory->newInsert('taximen', $row)
            ->execute()
            ->lastInsertId();
    }

    /**
     * Get taximan by id.
     *
     * @param int $taximanId The taximan id
     *
     * @throws DomainException
     *
     * @return TaximanData The taximan
     */
    public function getTaximanById(int $taximanId): TaximanData
    {
        $query = $this->queryFactory->newSelect('taximen');
        $query->select(
            [
                'id',
                'agent_id',
                'identification_number',
                'first_name',
                'last_name',
                'phone_number',
                'neighborhood',
                'gray_card',
                'driving_licence_number',
                'id_card_number',
                'owner',
                'insurance',
                'transport_license',
                'sticker_validity_date',
                'technical_visit_validity_date',
                'registration_number',
                'customs_clearance_certificate',
                'vest_number',
                'commune_of',
                'division',
                'region',
                'identification_date',
                'last_modified',
            ]
        );

        $query->andWhere(['id' => $taximanId]);

        $row = $query->execute()->fetch('assoc');

        if (!$row) {
            throw new DomainException(sprintf('User not found: %s', $taximanId));
        }

        return new TaximanData($row);
    }

    /**
     * Update taximan row.
     *
     * @param TaximanData $taximan The taximan
     *
     * @return void
     */
    public function updateTaximan(TaximanData $taximan): void
    {
        $row = $this->toRow($taximan);

        $row['last_modified'] = Chronos::now()->toDateTimeString();

        $this->queryFactory->newUpdate('taximen', $row)
            ->andWhere(['id' => $taximan->id])
            ->execute();
    }

    /**
     * Check taximan id.
     *
     * @param int $taximanId The taximan id
     *
     * @return bool True if exists
     */
    public function existsTaximanId(int $taximanId): bool
    {
        $query = $this->queryFactory->newSelect('taximen');
        $query->select('id')->andWhere(['id' => $taximanId]);

        return (bool)$query->execute()->fetch('assoc');
    }

    /**
     * Delete taximan row.
     *
     * @param int $taximanId The taximan id
     *
     * @return void
     */
    public function deleteTaximanById(int $taximanId): void
    {
        $this->queryFactory->newDelete('taximen')
            ->andWhere(['id' => $taximanId])
            ->execute();
    }

    /**
     * Convert to array.
     *
     * @param TaximanData $taximan The taximan data
     *
     * @return array The array
     */
    private function toRow(TaximanData $taximan): array
    {
        return [
            'id' => $taximan->id,
            'agent_id' => $taximan->agentId,
            'identification_number' => $taximan->identificationNumber,
            'first_name' => $taximan->firstName,
            'last_name' => $taximan->lastName,
            'phone_number' => $taximan->phoneNumber,
            'neighborhood' => $taximan->neighborhood,
            'owner' => $taximan->owner,
            'commune_of' => $taximan->communeOf
        ];
    }
}
