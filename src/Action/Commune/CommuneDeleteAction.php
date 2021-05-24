<?php


namespace App\Action\Commune;

use App\Domain\Commune\Service\CommuneDeleter;
use App\Responder\Responder;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Action
 * Class CommuneDeleteAction
 * @package App\Action\Commune
 */
class CommuneDeleteAction
{
    private CommuneDeleter $communeDeleter;

    private Responder $responder;

    /**
     * The constructor.
     *
     * @param CommuneDeleter $communeDeleter The service
     * @param Responder $responder The responder
     */
    public function __construct(CommuneDeleter $communeDeleter, Responder $responder)
    {
        $this->communeDeleter = $communeDeleter;
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
        $communeId = (int)$args['commune_id'];

        // Invoke the domain (service class)
        $this->communeDeleter->deleteCommune($communeId);

        // Render the json response
        return $this->responder->withJson($response);
    }

}
