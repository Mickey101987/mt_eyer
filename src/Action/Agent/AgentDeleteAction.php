<?php


namespace App\Action\Agent;

use App\Domain\Agent\Service\AgentDeleter;
use App\Responder\Responder;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Action
 * Class AgentDeleteAction
 * @package App\Action\Agent
 */
final class AgentDeleteAction
{
    private AgentDeleter $agentDeleter;

    private Responder $responder;

    /**
     * The constructor.
     *
     * @param AgentDeleter $agentDeleter The service
     * @param Responder $responder The responder
     */
    public function __construct(AgentDeleter $agentDeleter, Responder $responder)
    {
        $this->agentDeleter = $agentDeleter;
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
        $this->agentDeleter->deleteAgent($agentId);

        // Render the json response
        return $this->responder->withJson($response);
    }

}
