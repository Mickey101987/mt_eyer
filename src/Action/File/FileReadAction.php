<?php


namespace App\Action\File;

use App\Domain\File\Data\FileData;
use App\Domain\File\Service\FileReader;
use App\Responder\Responder;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Action
 * Class FileReadAction
 * @package App\Action\File
 */
final class FileReadAction
{
    private FileReader $fileReader;

    private Responder $responder;

    /**
     * The constructor.
     *
     * @param FileReader $fileViewer The service
     * @param Responder $responder The responder
     */
    public function __construct(FileReader $fileViewer, Responder $responder)
    {
        $this->fileReader = $fileViewer;
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
        $file = $this->fileReader->getFileData($fileId);

        // Transform result
        return $this->transform($response, $file);
    }

    /**
     * Transform result to response.
     *
     * @param ResponseInterface $response The response
     * @param FileData $file The file
     *
     * @return ResponseInterface The response
     */
    private function transform(ResponseInterface $response, FileData $file): ResponseInterface
    {
        // Turn that object into a structured array
        $data = [
            'id' => $file->id,
            'file_type' => $file->fileType,
            'file_path' => $file->filePath,
            'doc_classifier' => $file->docClassifier,
            'taximan_id' => $file->taximanId,
            'expiration_date' => $file->expirationDate,
            'last_modified' => $file->lastModified,
            'created_at' => $file->createdAt
        ];

        // Turn all of that into a JSON string and put it into the response body
        return $this->responder->withJson($response, $data);
    }

}
