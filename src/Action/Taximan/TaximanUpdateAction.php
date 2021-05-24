<?php

namespace App\Action\Taximan;

use App\Domain\Taximan\Service\TaximanUpdater;
use App\Responder\Responder;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Action
 * Class TaximanUpdateAction
 * @package App\Action\Taximan
 */
final class TaximanUpdateAction
{
    private Responder $responder;

    private TaximanUpdater $taximanUpdater;

    /**
     * The constructor.
     *
     * @param Responder $responder The responder
     * @param TaximanUpdater $taximanUpdater The service
     */
    public function __construct(Responder $responder, TaximanUpdater $taximanUpdater)
    {
        $this->responder = $responder;
        $this->taximanUpdater = $taximanUpdater;
    }

    /**
     * Action.
     *
     * @param ServerRequestInterface $request The request
     * @param ResponseInterface $response The response
     * @param array $args The route arguments
     *
     * @return ResponseInterface The response
     */
    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response,
        array $args
    ): ResponseInterface {
        // Extract the form data from the request body
        $taximanId = (int)$args['taximan_id'];
        $data = (array)$request->getParsedBody();

        // Invoke the Domain with inputs and retain the result
        $this->taximanUpdater->updateTaximan($taximanId, $data);

        // Build the HTTP response
        return $this->responder->withJson($response);
    }
}
