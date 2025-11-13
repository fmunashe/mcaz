<?php

namespace App\Http\Ussd\States\MainDashboard\QualityProblemReport;

use App\Http\Ussd\States\MainDashboard\QualityProblemReport\Defects\PresenceOfForeignMaterial;
use App\Models\ProductDefect;
use App\OTPGeneration;
use Sparors\Ussd\State;

class ReporterSignature extends State
{
    use OTPGeneration;

    protected function beforeRendering(): void
    {
        $this->menu->line('Reporter Signature (initials e.g FZ)');
    }

    protected function afterRendering(string $argument): void
    {
        $this->record->set('reporterSignature', $argument);
        $this->reportQualityProblem();
        $this->decision->any(PresenceOfForeignMaterial::class);
    }

    private function reportQualityProblem()
    {
        $referenceNumber = $this->generateReferenceNumber();
        $this->record->set('referenceNumber', $referenceNumber);
        $productName = $this->record->get('productName');
        $descriptionOfDevice = $this->record->get('descriptionOfDevice');
        $intendedUse = $this->record->get('intendedUse');
        $typeOfContainer = $this->record->get('typeOfContainer');
        $registrationNumber = $this->record->get('registrationNumber');
        $batchNumber = $this->record->get('batchNumber');
        $expiryDate = $this->record->get('expiryDate');
        $nameOfManufacturer = $this->record->get('nameOfManufacturer');
        $addressOfManufacturer = $this->record->get('addressOfManufacturer');
        $nameOfReporter = $this->record->get('nameOfReporter');
        $titleOfReporter = $this->record->get('titleOfReporter');
        $practiseLocation = $this->record->get('practiseLocation');
        $practiseAddress = $this->record->get('practiseAddress');
        $phoneNumber = $this->record->get('phoneNumber');
        $dateProblemObserved = $this->record->get('dateProblemObserved');
        $productAvailableForExamination = $this->record->get('productAvailableForExamination');
        $reporterSignature = $this->record->get('reporterSignature');

        ProductDefect::create([
            'report_number' => $referenceNumber,
            'product_name' => $productName,
            'description' => $descriptionOfDevice,
            'intended_use' => $intendedUse,
            'type_of_container' => $typeOfContainer,
            'registration_number' => $registrationNumber,
            'batch_number' => $batchNumber,
            'expiry_date' => $expiryDate,
            'name_of_manufacturer' => $nameOfManufacturer,
            'address_of_manufacturer' => $addressOfManufacturer,
            'name_of_reporter' => $nameOfReporter,
            'title_of_reporter' => $titleOfReporter,
            'practice_location' => $practiseLocation,
            'practise_address' => $practiseAddress,
            'phone_number' => $phoneNumber,
            'date_problem_observed' => $dateProblemObserved,
            'product_available_for_examination' => $productAvailableForExamination,
            'reporter_signature' => $reporterSignature
        ]);
    }
}
