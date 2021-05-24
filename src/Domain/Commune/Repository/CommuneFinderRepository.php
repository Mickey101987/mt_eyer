<?php


namespace App\Domain\Commune\Repository;

use App\Domain\Commune\Data\CommuneData;
use App\Factory\QueryFactory;

/**
 * Repository
 * Class CommuneFinderRepository
 * @package App\Domain\Commune\Repository
 */
final class CommuneFinderRepository
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
     * Find communes.
     *
     * @return CommuneData[] A list of communes
     */
    public function findCommune(): array
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

        // Add more "use case specific" conditions to the query
        // ...

        $rows = $query->execute()->fetchAll('assoc') ?: [];

        // Convert to list of objects
        return hydrate($rows, CommuneData::class);
    }

}
