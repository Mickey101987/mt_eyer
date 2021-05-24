<?php


namespace App\Action\File;

use App\Domain\File\Service\FileFinder;
use App\Responder\Responder;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Action
 * Class FileFindAction
 * @package App\Action\File
 */
final class FileFindAction
{
    private FileFinder $fileFinder;

    private Responder $responder;

    /**
     * The constructor.
     *
     * @param FileFinder $fileIndex The file index list viewer
     * @param Responder $responder The responder
     */
    public function __construct(FileFinder $fileIndex, Responder $responder)
    {
        $this->fileFinder = $fileIndex;
        $this->responder = $responder;
    }

    /**
     * Action.
     *
     * @param ServerRequestInterface $request The request
     * @param ResponseInterface $response The response
     *
     * @param $args
     * @return ResponseInterface The response
     */
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, $args): ResponseInterface
    {
        $taximanId = (int)$args['taximan_id'];
        // Optional: Pass parameters from the request to the findFile method
        $files = $this->fileFinder->findFile($taximanId);

        return $this->transform($response, $files);
    }

    /**
     * Transform to json response.
     * This could also be done within a specific Responder class.
     *
     * @param ResponseInterface $response The response
     * @param array $files The files
     *
     * @return ResponseInterface The response
     */
    private function transform(ResponseInterface $response, array $files): ResponseInterface
    {
        $fileList = [];

        foreach ($files as $file) {
            $fileList[] = [
                'id' => $file->id,
                'file_type' => $file->fileType,
                'file_path' => $file->filePath,
                'doc_classifier' => $file->docClassifier,
                'taximan_id' => $file->taximanId,
                'expiration_date' => $file->expirationDate,
                'last_modified' => $file->lastModified,
                'created_at' => $file->createdAt
            ];
        }

        return $this->responder->withJson(
            $response,
            [
                'files' => $fileList,
            ]
        );
    }

}
