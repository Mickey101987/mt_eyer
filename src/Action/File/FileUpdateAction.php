<?php


namespace App\Action\File;

use App\Domain\File\Service\FileUpdater;
use App\Responder\Responder;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Action
 * Class FileUpdateAction
 * @package App\Action\File
 */
final class FileUpdateAction
{
    private Responder $responder;

    private FileUpdater $fileUpdater;

    /**
     * The constructor.
     *
     * @param Responder $responder The responder
     * @param FileUpdater $fileUpdater The service
     */
    public function __construct(Responder $responder, FileUpdater $fileUpdater)
    {
        $this->responder = $responder;
        $this->fileUpdater = $fileUpdater;
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
        $fileId = (int)$args['file_id'];
        $data = (array)$request->getParsedBody();

        // Invoke the Domain with inputs and retain the result
        $this->fileUpdater->updateFile($fileId, $data);

        // Build the HTTP response
        return $this->responder->withJson($response);
    }

}
