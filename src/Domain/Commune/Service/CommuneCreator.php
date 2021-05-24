<?php


namespace App\Domain\Commune\Service;

use App\Domain\Commune\Data\CommuneData;
use App\Domain\Commune\Repository\CommuneRepository;
use App\Factory\LoggerFactory;
use Psr\Log\LoggerInterface;

/**
 * Service
 * Class CommuneCreator
 * @package App\Domain\Commune\Service
 */
final class CommuneCreator
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
            ->addFileHandler('commune_creator.log')
            ->createLogger();
    }

    /**
     * Create a new commune.
     *
     * @param array<mixed> $data The form data
     *
     * @return int The new commune ID
     */
    public function createCommune(array $data): int
    {
        // Input validation
        $this->communeValidator->validateCommune($data);

        // Map form data to commune DTO (model)
        $commune = new CommuneData($data);

        // Insert commune and get new commune ID
        $communeId = $this->repository->insertCommune($commune);

        // Logging
        $this->logger->info(sprintf('Commune created successfully: %s', $communeId));

        return $communeId;
    }

}
