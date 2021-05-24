<?php


namespace App\Action\Agent;

use App\Domain\Agent\Data\AgentData;
use App\Domain\Agent\Service\AgentReader;
use App\Responder\Responder;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Action
 * Class AgentReadAction
 * @package App\Action\Agent
 */
final class AgentReadAction
{
    private AgentReader $agentReader;

    private Responder $responder;

    /**
     * The constructor.
     *
     * @param AgentReader $agentViewer The service
     * @param Responder $responder The responder
     */
    public function __construct(AgentReader $agentViewer, Responder $responder)
    {
        $this->agentReader = $agentViewer;
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
        $agentId = (int)$args['agent_id'];

        // Invoke the domain (service class)
        $agent = $this->agentReader->getAgentData($agentId);

        // Transform result
        return $this->transform($response, $agent);
    }

    /**
     * Transform result to response.
     *
     * @param ResponseInterface $response The response
     * @param AgentData $agent The agent
     *
     * @return ResponseInterface The response
     */
    private function transform(ResponseInterface $response, AgentData $agent): ResponseInterface
    {
        // Turn that object into a structured array
        $data = [
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

        // Turn all of that into a JSON string and put it into the response body
        return $this->responder->withJson($response, $data);
    }

}
