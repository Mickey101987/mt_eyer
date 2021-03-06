<?php


namespace App\Action\Commune;

use App\Domain\Commune\Service\CommuneUpdater;
use App\Responder\Responder;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Action
 * Class CommuneUpdateAction
 * @package App\Action\Commune
 */
final class CommuneUpdateAction
{
    private Responder $responder;

    private CommuneUpdater $communeUpdater;

    /**
     * The constructor.
     *
     * @param Responder $responder The responder
     * @param CommuneUpdater $communeUpdater The service
     */
    public function __construct(Responder $responder, CommuneUpdater $communeUpdater)
    {
        $this->responder = $responder;
        $this->communeUpdater = $communeUpdater;
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
        $communeId = (int)$args['commune_id'];
        $data = (array)$request->getParsedBody();

        // Invoke the Domain with inputs and retain the result
        $this->communeUpdater->updateCommune($communeId, $data);

        // Build the HTTP response
        return $this->responder->withJson($response);
    }

}
