<?php


namespace App\Action\Agent;

use App\Domain\Agent\Service\AgentUpdater;
use App\Responder\Responder;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Action
 * Class AgentUpdateAction
 * @package App\Action\Agent
 */
final class AgentUpdateAction
{
    private Responder $responder;

    private AgentUpdater $agentUpdater;

    /**
     * The constructor.
     *
     * @param Responder $responder The responder
     * @param AgentUpdater $agentUpdater The service
     */
    public function __construct(Responder $responder, AgentUpdater $agentUpdater)
    {
        $this->responder = $responder;
        $this->agentUpdater = $agentUpdater;
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
        $agentId = (int)$args['agent_id'];
        $data = (array)$request->getParsedBody();

        // Invoke the Domain with inputs and retain the result
        $this->agentUpdater->updateAgent($agentId, $data);

        // Build the HTTP response
        return $this->responder->withJson($response);
    }

}
