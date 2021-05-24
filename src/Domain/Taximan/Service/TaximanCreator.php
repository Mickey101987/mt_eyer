<?php

namespace App\Domain\Taximan\Service;

use App\Domain\Taximan\Data\TaximanData;
use App\Domain\Taximan\Repository\TaximanRepository;
use App\Factory\LoggerFactory;
use Psr\Log\LoggerInterface;

/**
 * Service
 * Class TaximanCreator
 * @package App\Domain\Taximan\Service
 */
final class TaximanCreator
{
    private TaximanRepository $repository;

    private TaximanValidator $taximanValidator;

    private LoggerInterface $logger;

    /**
     * The constructor.
     *
     * @param TaximanRepository $repository The repository
     * @param TaximanValidator $taximanValidator The validator
     * @param LoggerFactory $loggerFactory The logger factory
     */
    public function __construct(
        TaximanRepository $repository,
        TaximanValidator $taximanValidator,
        LoggerFactory $loggerFactory
    ) {
        $this->repository = $repository;
        $this->taximanValidator = $taximanValidator;
        $this->logger = $loggerFactory
            ->addFileHandler('taximan_creator.log')
            ->createLogger();
    }

    /**
     * Create a new taximan.
     *
     * @param array<mixed> $data The form data
     *
     * @return int The new taximan ID
     */
    public function createTaximan(array $data): int
    {
        // Input validation
        $this->taximanValidator->validateTaximan($data);

        // Map form data to taximan DTO (model)
        $taximan = new TaximanData($data);

        // Insert taximan and get new taximan ID
        $taximanId = $this->repository->insertTaximan($taximan);

        // Logging
        $this->logger->info(sprintf('Taximan created successfully: %s', $taximanId));

        return $taximanId;
    }
}
