<?php

namespace App\Action\Taximan;

use App\Domain\Taximan\Service\TaximanCreator;
use App\Responder\Responder;
use Fig\Http\Message\StatusCodeInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Class TaximanCreateAction
 * @package App\Action\Taximan
 */
final class TaximanCreateAction
{
    private Responder $responder;

    private TaximanCreator $taximanCreator;

    /**
     * TaximanCreateAction constructor.
     * @param Responder $responder The responder
     * @param TaximanCreator $taximanCreator The service
     */
    public function __construct(Responder $responder, TaximanCreator $taximanCreator)
    {
        $this->responder = $responder;
        $this->taximanCreator = $taximanCreator;
    }

    /**
     * Action.
     *
     * @param ServerRequestInterface $request The request
     * @param ResponseInterface $response The response
     *
     * @return ResponseInterface The response
     */
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        // Extract the form data from the request body
        $data = (array)$request->getParsedBody();

        // Invoke the Domain with inputs and retain the result
        $taximanId = $this->taximanCreator->createTaximan($data);

        // Build the HTTP response
        return $this->responder
            ->withJson($response, ['taximan_id' => $taximanId])
            ->withStatus(StatusCodeInterface::STATUS_CREATED);
    }
}
