<?php


namespace App\Action\Agent;

use App\Domain\Agent\Service\AgentCreator;
use App\Responder\Responder;
use Fig\Http\Message\StatusCodeInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Action
 * Class AgentCreateAction
 * @package App\Action\Agent
 */
final class AgentCreateAction
{
    private Responder $responder;

    private AgentCreator $agentCreator;

    /**
     * AgentCreateAction constructor.
     * @param Responder $responder The responder
     * @param AgentCreator $agentCreator The service
     */
    public function __construct(Responder $responder, AgentCreator $agentCreator)
    {
        $this->responder = $responder;
        $this->agentCreator = $agentCreator;
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
        $agentId = $this->agentCreator->createAgent($data);

        // Build the HTTP response
        return $this->responder
            ->withJson($response, ['agent_id' => $agentId])
            ->withStatus(StatusCodeInterface::STATUS_CREATED);
    }

}
