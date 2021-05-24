<?php


namespace App\Action\Agent;

use App\Domain\Agent\Service\AgentFinder;
use App\Responder\Responder;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Action
 * Class AgentFindAction
 * @package App\Action\Agent
 */
final class AgentFindAction
{
    private AgentFinder $agentFinder;

    private Responder $responder;

    /**
     * The constructor.
     *
     * @param AgentFinder $agentIndex The agent index list viewer
     * @param Responder $responder The responder
     */
    public function __construct(AgentFinder $agentIndex, Responder $responder)
    {
        $this->agentFinder = $agentIndex;
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
        // Optional: Pass parameters from the request to the findAgent method
        $agents = $this->agentFinder->findAgent();

        return $this->transform($response, $agents);
    }

    /**
     * Transform to json response.
     * This could also be done within a specific Responder class.
     *
     * @param ResponseInterface $response The response
     * @param array $agents The agents
     *
     * @return ResponseInterface The response
     */
    private function transform(ResponseInterface $response, array $agents): ResponseInterface
    {
        $agentList = [];

        foreach ($agents as $agent) {
            $agentList[] = [
                'id' => $agent->id,
                'commune_id' => $agent->communeId,
                'full_name' => $agent->fullName,
                'matricule_number' => $agent->matriculeNumber,
                'username' => $agent->username,
                'password' => $agent->password,
                'user_id' => $agent->adminId,
                'status' => $agent->status,
                'last_modified' => $agent->lastModified,
                'created_at' => $agent->createdAt
            ];
        }

        return $this->responder->withJson(
            $response,
            [
                'agents' => json_encode($agentList)
            ]
        );
    }

}
