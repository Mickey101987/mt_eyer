<?php

namespace App\Domain\Taximan\Repository;

use App\Domain\Taximan\Data\TaximanData;
use App\Factory\QueryFactory;

/**
 * Class TaximanFinderRepository
 * @package App\Domain\Taximan\Repository
 */
final class TaximanFinderRepository
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
     * Find taximen.
     *
     * @param int|null $agentId
     * @return TaximanData[] A list of taximem
     */
    public function findTaximan(int $agentId = null): array
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

        if ($agentId){
            $query->andWhere(['agent_id' => $agentId]);
        }

        $rows = $query->execute()->fetchAll('assoc') ?: [];

        // Convert to list of objects
        return hydrate($rows, TaximanData::class);
    }
}
