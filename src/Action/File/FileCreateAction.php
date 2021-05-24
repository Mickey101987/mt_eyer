<?php


namespace App\Action\File;

use App\Domain\File\Service\FileCreator;
use App\Responder\Responder;
use Fig\Http\Message\StatusCodeInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Action
 * Class FileCreateAction
 * @package App\Action\File
 */
class FileCreateAction
{
    private Responder $responder;

    private FileCreator $fileCreator;

    /**
     * FileCreateAction constructor.
     * @param Responder $responder The responder
     * @param FileCreator $fileCreator The service
     */
    public function __construct(Responder $responder, FileCreator $fileCreator)
    {
        $this->responder = $responder;
        $this->fileCreator = $fileCreator;
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
        $fileId = $this->fileCreator->createFile($data);

        // Build the HTTP response
        return $this->responder
            ->withJson($response, ['file_id' => $fileId])
            ->withStatus(StatusCodeInterface::STATUS_CREATED);
    }

}
