<?php


namespace App\Domain\Agent\Repository;

use App\Domain\Agent\Data\AgentData;
use App\Factory\QueryFactory;
use Cake\Chronos\Chronos;
use DomainException;

/**
 * Repository
 * Class AgentRepository
 * @package App\Domain\Agent\Repository
 */
final  class AgentRepository
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
     * Insert agent row.
     *
     * @param AgentData $agent The agent data
     *
     * @return int The new ID
     */
    public function insertAgent(AgentData $agent): int
    {
        $row = $this->toRow($agent);
        $row['created_at'] = Chronos::now()->toDateTimeString();

        return (int)$this->queryFactory->newInsert('agents', $row)
            ->execute()
            ->lastInsertId();
    }

    /**
     * Get agent by id.
     *
     * @param int $agentId The agent id
     *
     * @throws DomainException
     *
     * @return AgentData The agent
     */
    public function getAgentById(int $agentId): AgentData
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
                'last_modified',
                'created_at'
            ]
        );

        $query->andWhere(['id' => $agentId]);

        $row = $query->execute()->fetch('assoc');

        if (!$row) {
            throw new DomainException(sprintf('User not found: %s', $agentId));
        }

        return new AgentData($row);
    }

    /**
     * Update agent row.
     *
     * @param AgentData $agent The agent
     *
     * @return void
     */
    public function updateAgent(AgentData $agent): void
    {
        $row = $this->toRow($agent);

        // Updating the password is another use case
        unset($row['password']);

        $row['last_modified'] = Chronos::now()->toDateTimeString();

        $this->queryFactory->newUpdate('agents', $row)
            ->andWhere(['id' => $agent->id])
            ->execute();
    }

    /**
     * Check agent id.
     *
     * @param int $agentId The agent id
     *
     * @return bool True if exists
     */
    public function existsAgentId(int $agentId): bool
    {
        $query = $this->queryFactory->newSelect('agents');
        $query->select('id')->andWhere(['id' => $agentId]);

        return (bool)$query->execute()->fetch('assoc');
    }

    /**
     * Delete agent row.
     *
     * @param int $agentId The agent id
     *
     * @return void
     */
    public function deleteAgentById(int $agentId): void
    {
        $this->queryFactory->newDelete('agents')
            ->andWhere(['id' => $agentId])
            ->execute();
    }

    /**
     * Convert to array.
     *
     * @param AgentData $agent The agent data
     *
     * @return array The array
     */
    private function toRow(AgentData $agent): array
    {
        return [
            'id' => $agent->id,
            'commune_id' => $agent->communeId,
            'user_id' => $agent->adminId,
            'full_name' => $agent->fullName,
            'matricule_number' => $agent->matriculeNumber,
            'username' => $agent->username,
            'password' => $agent->password,
            'last_modified' => $agent->lastModified,
            'created_at' => $agent->createdAt
        ];
    }

}
