<?php


namespace App\Action\Commune;

use App\Domain\Commune\Service\CommuneCreator;
use App\Responder\Responder;
use Fig\Http\Message\StatusCodeInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Action
 * Class CommuneCreateAction
 * @package App\Action\Commune
 */
final class CommuneCreateAction
{
    private Responder $responder;

    private CommuneCreator $communeCreator;

    /**
     * CommuneCreateAction constructor.
     * @param Responder $responder The responder
     * @param CommuneCreator $communeCreator The service
     */
    public function __construct(Responder $responder, CommuneCreator $communeCreator)
    {
        $this->responder = $responder;
        $this->communeCreator = $communeCreator;
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
        $communeId = $this->communeCreator->createCommune($data);

        // Build the HTTP response
        return $this->responder
            ->withJson($response, ['commune_id' => $communeId])
            ->withStatus(StatusCodeInterface::STATUS_CREATED);
    }

}
