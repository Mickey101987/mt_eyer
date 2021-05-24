<?php


namespace App\Domain\Commune\Service;

use App\Domain\Commune\Data\CommuneData;
use App\Domain\Commune\Repository\CommuneRepository;
use App\Factory\LoggerFactory;
use Psr\Log\LoggerInterface;

/**
 * Service
 * Class CommuneUpdater
 * @package App\Domain\Commune\Service
 */
final class CommuneUpdater
{
    private CommuneRepository $repository;

    private CommuneValidator $communeValidator;

    private LoggerInterface $logger;

    /**
     * The constructor.
     *
     * @param CommuneRepository $repository The repository
     * @param CommuneValidator $communeValidator The validator
     * @param LoggerFactory $loggerFactory The logger factory
     */
    public function __construct(
        CommuneRepository $repository,
        CommuneValidator $communeValidator,
        LoggerFactory $loggerFactory
    ) {
        $this->repository = $repository;
        $this->communeValidator = $communeValidator;
        $this->logger = $loggerFactory
            ->addFileHandler('commune_updater.log')
            ->createLogger();
    }

    /**
     * Update commune.
     *
     * @param int $communeId The commune id
     * @param array<mixed> $data The request data
     *
     * @return void
     */
    public function updateCommune(int $communeId, array $data): void
    {
        // Input validation
        $this->communeValidator->validateCommuneUpdate($communeId, $data);

        // Validation was successfully
        $commune = new CommuneData($data);
        $commune->id = $communeId;

        // Update the commune
        $this->repository->updateCommune($commune);

        // Logging
        $this->logger->info(sprintf('Commune updated successfully: %s', $communeId));
    }

}
