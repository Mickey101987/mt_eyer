<?php


namespace App\Action\Commune;

use App\Domain\Commune\Data\CommuneData;
use App\Domain\Commune\Service\CommuneReader;
use App\Responder\Responder;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Action
 * Class CommuneReadAction
 * @package App\Action\Commune
 */
final class CommuneReadAction
{
    private CommuneReader $communeReader;

    private Responder $responder;

    /**
     * The constructor.
     *
     * @param CommuneReader $communeViewer The service
     * @param Responder $responder The responder
     */
    public function __construct(CommuneReader $communeViewer, Responder $responder)
    {
        $this->communeReader = $communeViewer;
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
        $commune = $this->communeReader->getCommuneData($communeId);

        // Transform result
        return $this->transform($response, $commune);
    }

    /**
     * Transform result to response.
     *
     * @param ResponseInterface $response The response
     * @param CommuneData $commune The commune
     *
     * @return ResponseInterface The response
     */
    private function transform(ResponseInterface $response, CommuneData $commune): ResponseInterface
    {
        // Turn that object into a structured array
        $data = [
            'id' => $commune->id,
            'name' => $commune->name,
            'type' => $commune->type,
            'region' => $commune->region,
            'department' => $commune->department,
            'population' => $commune->population,
            'logo' => $commune->logo,
            'description' => $commune->description,
            'last_modified' => $commune->lastModified,
            'created_at' => $commune->createdAt
        ];

        // Turn all of that into a JSON string and put it into the response body
        return $this->responder->withJson($response, $data);
    }

}
