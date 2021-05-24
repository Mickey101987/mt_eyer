<?php

namespace App\Action\Taximan;

use App\Domain\Taximan\Service\TaximanFinder;
use App\Responder\Responder;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Action.
 */
final class TaximanFindAction
{
    private TaximanFinder $taximanFinder;

    private Responder $responder;

    /**
     * The constructor.
     *
     * @param TaximanFinder $taximanIndex The taximan index list viewer
     * @param Responder $responder The responder
     */
    public function __construct(TaximanFinder $taximanIndex, Responder $responder)
    {
        $this->taximanFinder = $taximanIndex;
        $this->responder = $responder;
    }

    /**
     * Action.
     *
     * @param ServerRequestInterface $request The request
     * @param ResponseInterface $response The response
     *
     * @return ResponseInterface The response
     */
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, $args): ResponseInterface
    {
        $agentId = isset($args['agent_id']) ? $args['agent_id'] : null;
        // Optional: Pass parameters from the request to the findTaximan method
        $taximen = $this->taximanFinder->findTaximan($agentId);

        return $this->transform($response, $taximen);
    }

    /**
     * Transform to json response.
     * This could also be done within a specific Responder class.
     *
     * @param ResponseInterface $response The response
     * @param array $taximen The taximen
     *
     * @return ResponseInterface The response
     */
    private function transform(ResponseInterface $response, array $taximen): ResponseInterface
    {
        $taximanList = [];

        foreach ($taximen as $taximan) {
            $taximanList[] = [
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
        }

        return $this->responder->withJson(
            $response,
            [
                'taximen' => json_encode($taximanList),
            ]
        );
    }
}
