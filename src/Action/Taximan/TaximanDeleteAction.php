<?php

namespace App\Action\Taximan;

use App\Domain\Taximan\Service\TaximanDeleter;
use App\Responder\Responder;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Action.
 */
final class TaximanDeleteAction
{
    private TaximanDeleter $taximanDeleter;

    private Responder $responder;

    /**
     * The constructor.
     *
     * @param TaximanDeleter $taximanDeleter The service
     * @param Responder $responder The responder
     */
    public function __construct(TaximanDeleter $taximanDeleter, Responder $responder)
    {
        $this->taximanDeleter = $taximanDeleter;
        $this->responder = $responder;
    }

    /**
     * Action.
     *
     * @param ServerRequestInterface $request The request
     * @param ResponseInterface $response The response
     * @param array<mixed> $args The routing arguments
     *
     * @return ResponseInterface The response
     */
    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response,
        array $args
    ): ResponseInterface {
        // Fetch parameters from the request
        $taximanId = (int)$args['taximan_id'];

        // Invoke the domain (service class)
        $this->taximanDeleter->deleteTaximan($taximanId);

        // Render the json response
        return $this->responder->withJson($response);
    }
}
