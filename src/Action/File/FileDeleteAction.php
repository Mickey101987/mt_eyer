<?php


namespace App\Action\File;

use App\Domain\File\Service\FileDeleter;
use App\Responder\Responder;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Action
 * Class FileDeleteAction
 * @package App\Action\File
 */
final class FileDeleteAction
{
    private FileDeleter $fileDeleter;

    private Responder $responder;

    /**
     * The constructor.
     *
     * @param FileDeleter $fileDeleter The service
     * @param Responder $responder The responder
     */
    public function __construct(FileDeleter $fileDeleter, Responder $responder)
    {
        $this->fileDeleter = $fileDeleter;
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
        $fileId = (int)$args['file_id'];

        // Invoke the domain (service class)
        $this->fileDeleter->deleteFile($fileId);

        // Render the json response
        return $this->responder->withJson($response);
    }

}
