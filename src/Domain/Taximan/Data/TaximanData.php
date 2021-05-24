<?php


namespace App\Domain\Taximan\Data;

use Selective\ArrayReader\ArrayReader;

/**
 * Class TaximanData
 * @package App\Domain\User\Data
 */
final class TaximanData
{
    public ?int $id =null;
    public ?int $agentId = null;
    public ?string $identificationNumber = null;
    public ?string $firstName = null;
    public ?string $lastName = null;
    public ?string $phoneNumber = null;
    public ?string $neighborhood = null;
    public ?bool $grayCard = false;
    public ?string $drivingLicenceNumber = null;
    public ?string $idCardNumber = null;
    public ?int $owner = null;
    public ?string $insurance = null;
    public ?string $transportLicense = null;
    public ?string $stickerValidityDate = null;
    public ?string $technicalVisitValidityDate = null;
    public ?string $registrationNumber = null;
    public ?bool $customsClearanceCertificate = false;
    public ?string $vestNumber = null;
    public ?string $communeOf = null;
    public ?string $division = null;
    public ?string $region = null;

    /**
     * TaximanData constructor.
     * @param array $data The data
     */
    public function __construct(array $data = [])
    {
        $reader = new ArrayReader($data);

        $this->id = $reader->findInt('id');
        $this->agentId = $reader->findInt('agent_id');
        $this->identificationNumber = $reader->findString('identification_number');
        $this->firstName = $reader->findString('first_name');
        $this->lastName = $reader->findString('last_name');
        $this->phoneNumber = $reader->findString('phone_number');
        $this->neighborhood = $reader->findString('neighborhood');
        $this->grayCard = $reader->findBool('gray_card');
        $this->drivingLicenceNumber = $reader->findString('driving_licence_number');
        $this->idCardNumber = $reader->findString('id_card_number');
        $this->owner = $reader->findInt('owner');
        $this->insurance = $reader->findString('insurance');
        $this->transportLicense = $reader->findString('transport_license');
        $this->stickerValidityDate = $reader->findString('sticker_validity_date');
        $this->technicalVisitValidityDate = $reader->findString('technical_visit_validity_date');
        $this->registrationNumber = $reader->findString('registration_number');
        $this->customsClearanceCertificate = $reader->findBool('customs_clearance_certificate');
        $this->vestNumber = $reader->findString('vest_number');
        $this->communeOf = $reader->findString('commune_of');
        $this->division = $reader->findString('division');
        $this->region = $reader->findString('region');

    }

}
