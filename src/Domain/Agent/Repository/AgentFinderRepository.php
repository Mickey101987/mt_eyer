<?php


namespace App\Domain\Agent\Repository;

use App\Domain\Agent\Data\AgentData;
use App\Factory\QueryFactory;

/**
 * Class AgentFinderRepository
 * @package App\Domain\Agent\Repository
 */
final class AgentFinderRepository
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
     * Find agents.
     *
     * @return AgentData[] A list of agents
     */
    public function findAgent(): array
    {
        $query = $this->queryFactory->newSelect('agents');

        $query->select(
            [
                'id',
                'commune_id',
                'user_id',
                'full_name',
                'matricule_number',
                'username',
                'password',
            ]
        );

        // Add more "use case specific" conditions to the query
        // ...

        $rows = $query->execute()->fetchAll('assoc') ?: [];

        // Convert to list of objects
        return hydrate($rows, AgentData::class);
    }

}
