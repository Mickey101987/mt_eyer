<?php


namespace App\Action\Commune;

use App\Domain\Commune\Service\CommuneFinder;
use App\Responder\Responder;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Action
 * Class CommuneFindAction
 * @package App\Action\Commune
 */
final class CommuneFindAction
{
    private CommuneFinder $communeFinder;

    private Responder $responder;

    /**
     * The constructor.
     *
     * @param CommuneFinder $communeIndex The commune index list viewer
     * @param Responder $responder The responder
     */
    public function __construct(CommuneFinder $communeIndex, Responder $responder)
    {
        $this->communeFinder = $communeIndex;
        $this->responder = $responder;
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
        // Optional: Pass parameters from the request to the findCommune method
        $communes = $this->communeFinder->findCommune();

        return $this->transform($response, $communes);
    }

    /**
     * Transform to json response.
     * This could also be done within a specific Responder class.
     *
     * @param ResponseInterface $response The response
     * @param array $communes The communes
     *
     * @return ResponseInterface The response
     */
    private function transform(ResponseInterface $response, array $communes): ResponseInterface
    {
        $communeList = [];

        foreach ($communes as $commune) {
            $communeList[] = [
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
        }

        return $this->responder->withJson(
            $response,
            [
                'communes' => json_encode($communeList),
            ]
        );
    }

}
