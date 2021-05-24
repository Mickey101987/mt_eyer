<?php

namespace App\Action\Taximan;

use App\Domain\Taximan\Data\TaximanData;
use App\Domain\Taximan\Service\TaximanReader;
use App\Responder\Responder;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Action.
 */
final class TaximanReadAction
{
    private TaximanReader $taximanReader;

    private Responder $responder;

    /**
     * The constructor.
     *
     * @param TaximanReader $taximanViewer The service
     * @param Responder $responder The responder
     */
    public function __construct(TaximanReader $taximanViewer, Responder $responder)
    {
        $this->taximanReader = $taximanViewer;
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
        $taximanId = (int)$args['taximan_id'];

        // Invoke the domain (service class)
        $taximan = $this->taximanReader->getTaximanData($taximanId);

        // Transform result
        return $this->transform($response, $taximan);
    }

    /**
     * Transform result to response.
     *
     * @param ResponseInterface $response The response
     * @param TaximanData $taximan The taximan
     *
     * @return ResponseInterface The response
     */
    private function transform(ResponseInterface $response, TaximanData $taximan): ResponseInterface
    {
        // Turn that object into a structured array
        $data = [
            'id' => $taximan->id,
            'agent_id' => $taximan->agentId,
            'identification_number' => $taximan->identificationNumber,
            'first_name' => $taximan->firstName,
            'last_name' => $taximan->lastName,
            'phone_number' => $taximan->phoneNumber,
            'neighborhood' => $taximan->neighborhood,
            'gray_card' => $taximan->grayCard,
            'driving_licence_number' => $taximan->drivingLicenceNumber,
            'id_card_number' => $taximan->idCardNumber,
            'owner' => $taximan->owner,
            'insurance' => $taximan->insurance,
            'transport_license' => $taximan->transportLicense,
            'sticker_validity_date' => $taximan->stickerValidityDate,
            'technical_visit_validity_date' => $taximan->technicalVisitValidityDate,
            'registration_number' => $taximan->registrationNumber,
            'customs_clearance_certificate' => $taximan->customsClearanceCertificate,
            'vest_number' => $taximan->vestNumber,
            'commune_of' => $taximan->communeOf,
            'division' => $taximan->division,
            'region' => $taximan->region,
        ];

        // Turn all of that into a JSON string and put it into the response body
        return $this->responder->withJson($response, $data);
    }
}
