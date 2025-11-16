<?php

namespace App\Http\Ussd\States\MainDashboard\AEFI;

use App\Models\ADRSeriousReason;
use App\Models\AdverseEvent;
use App\Models\AEFI;
use App\Models\AEFIAdverseEvent;
use App\Models\AEFISeverity;
use App\Models\RelevantMedicalHistory;
use App\Models\Vaccine;
use Sparors\Ussd\State;

class Comments extends State
{
    protected function beforeRendering(): void
    {
        $this->menu->line('Comments');
    }

    protected function afterRendering(string $argument): void
    {
        $this->record->set('comments', $argument);
        $this->saveAefi();
        $this->decision->any(AEFIReportSuccessful::class);
    }

    private function saveAefi(): void
    {
        $patientName = $this->record->get('patientFullName');
        $patientAddress = $this->record->get('patientAddress');
        $patientTelephone = $this->record->get('patientTelephone');
        $gender = $this->record->get('genderId');
        $pregnancyStatus = $this->record->get('pregnancyStatus');
        $dateOfBirth = $this->record->get('dateOfBirth');
        $patientAge = $this->record->get('patientAge');
        $ageGroupId = $this->record->get('ageGroupId');
        $reporterName = $this->record->get('reporterName');
        $institution = $this->record->get('institution');
        $designation = $this->record->get('designation');
        $address = $this->record->get('address');
        $phoneNumber = $this->record->get('phoneNumber');
        $emailAddress = $this->record->get('emailAddress');
        $dateOfEventNotification = $this->record->get('dateOfEventNotification');
        $healthFacilityName = $this->record->get('healthFacilityName');
        $dateAefiStarted = $this->record->get('dateAefiStarted');
        $serious = $this->record->get('serious');
        $aefiOutcomeId = $this->record->get('aefiOutcomeId');
        $dateOfDeath = $this->record->get('dateOfDeath');
        $autopsyDone = $this->record->get('autopsyDone');
        $investigationNeeded = $this->record->get('investigationNeeded');
        $dateInvestigationPlanned = $this->record->get('dateInvestigationPlanned');
        $comments = $this->record->get('comments');

        $aefi = Aefi::create([
            'patient_name' => $patientName,
            'patient_full_address' => $patientAddress,
            'telephone' => $patientTelephone,
            'gender_id' => $gender,
            'pregnancy_status' => $pregnancyStatus,
            'dob' => $dateOfBirth,
            'age' => $patientAge,
            'age_group_id' => $ageGroupId,
            'reported_by' => $reporterName,
            'institution' => $institution,
            'designation' => $designation,
            'address' => $address,
            'phone_number' => $phoneNumber,
            'email_address' => $emailAddress,
            'date_of_event_notification' => $dateOfEventNotification,
            'health_facility_name' => $healthFacilityName,
            'date_aefi_started' => $dateAefiStarted,
            'serious' => $serious,
            'a_d_r_outcome_id' => $aefiOutcomeId,
            'date_of_death' => $dateOfDeath,
            'autopsy_done' => $autopsyDone,
            'investigation_needed' => $investigationNeeded,
            'date_investigation_planned' => $dateInvestigationPlanned,
            'comments' => $comments
        ]);

        $this->saveAefiVaccines($aefi);
        $this->processAefiAdverseEvents($aefi);
        $this->saveAefiSeverities($aefi);
        $this->saveAefiPastMedicalHistory($aefi);
    }

    private function saveAefiSeverities(AEFI $aefi): void
    {
        $death = $this->record->get('seriousDeath');
        $lifeThreatening = $this->record->get('seriousLifeThreatening');
        $disability = $this->record->get('seriousDisability');
        $hospitalization = $this->record->get('hospitalization');
        $congenitalAnomaly = $this->record->get('congenitalAnomaly');
        $otherReason = $this->record->get('otherReason');

        if ($death == 'Yes') {
            $severity = $this->getSeverityByName('Death');
            $this->createAefiSeverity($aefi, $severity);
        }
        if ($lifeThreatening == 'Yes') {
            $severity = $this->getSeverityByName('Life-threatening');
            $this->createAefiSeverity($aefi, $severity);
        }
        if ($disability == 'Yes') {
            $severity = $this->getSeverityByName('Disabling');
            $this->createAefiSeverity($aefi, $severity);
        }
        if ($hospitalization == 'Yes') {
            $severity = $this->getSeverityByName('Hospitalization/prolonged');
            $this->createAefiSeverity($aefi, $severity);
        }
        if ($congenitalAnomaly == 'Yes') {
            $severity = $this->getSeverityByName('Congenital-anomaly');
            $this->createAefiSeverity($aefi, $severity);
        }
        if ($otherReason == 'Yes') {
            $severity = $this->getSeverityByName('Other medically important condition');
            $this->createAefiSeverity($aefi, $severity);
        }
    }

    private function createAefiSeverity(AEFI $aefi, ADRSeriousReason $severity): void
    {
        AEFISeverity::create([
            'a_e_f_i_id' => $aefi->id,
            'a_d_r_serious_reason_id' => $severity->id,
        ]);
    }

    private function saveAefiPastMedicalHistory(AEFI $aefi): void
    {
        $labTestResult = $this->record->get('labTestResult');
        $actionTaken = $this->record->get('actionTaken');
        $aefiPastMedicalHistoryOutcomeId = $this->record->get('aefiPastMedicalHistoryOutcomeId');
        RelevantMedicalHistory::create([
            'a_e_f_i_id' => $aefi->id,
            'lab_test_results' => $labTestResult,
            'action_taken_id' => $actionTaken,
            'a_d_r_outcome_id' => $aefiPastMedicalHistoryOutcomeId,
        ]);
    }

    private function saveAefiVaccines(AEFI $aefi): void
    {
        $count = $this->record->get('vaccineCount');
        for ($i = 1; $i <= $count; $i++) {
            $name = $this->record->get('vaccineName' . $i);
            $brand = $this->record->get('brandName' . $i);
            $manufacturer = $this->record->get('manufacturer' . $i);
            $dateOfVaccination = $this->record->get('dateOfVaccination' . $i);
            $timeOfVaccination = $this->record->get('timeOfVaccination' . $i);
            $dose = $this->record->get('dose' . $i);
            $batchNumber = $this->record->get('batchNumber' . $i);
            $expiryDate = $this->record->get('expiryDate' . $i);
            $diluentBatchNumber = $this->record->get('diluentBatchNumber' . $i);
            $diluentExpiryDate = $this->record->get('diluentExpiryDate' . $i);
            $diluentTimeOfReconstitution = $this->record->get('diluentTimeOfReconstitution' . $i);
            Vaccine::create([
                'a_e_f_i_id' => $aefi->id,
                'vaccine_name' => $name,
                'brand_name' => $brand,
                'manufacturer' => $manufacturer,
                'date_of_vaccination' => $dateOfVaccination,
                'time_of_vaccination' => $timeOfVaccination,
                'dose' => $dose,
                'batch_number' => $batchNumber,
                'expiry_date' => $expiryDate,
                'diluent_batch_number' => $diluentBatchNumber,
                'diluent_expiry_date' => $diluentExpiryDate,
                'diluent_time_of_reconstitution' => $diluentTimeOfReconstitution
            ]);
        }
    }

    private function processAefiAdverseEvents(AEFI $aefi): void
    {
        $severeLocalReaction = $this->record->get('severeLocalReaction');
        $seizures = $this->record->get('seizures');
        $abscess = $this->record->get('abscess');
        $sepsis = $this->record->get('sepsis');
        $encephalopathy = $this->record->get('encephalopathy');
        $toxicShockSyndrome = $this->record->get('toxicShockSyndrome');
        $thrombocytopenia = $this->record->get('thrombocytopenia');
        $anaphylaxis = $this->record->get('anaphylaxis');
        $fever = $this->record->get('fever');
        $beyondNearestJoint = $this->record->get('beyondNearestJoint');
        $febrile = $this->record->get('febrile');
        $afebrile = $this->record->get('afebrile');
        $other = $this->record->get('other');

        if ($severeLocalReaction == 'Yes') {
            $adverseEvent = $this->getAdverseEventByName('Severe local reaction');
            $this->createAefiAdverseEvent($aefi, $adverseEvent);
        }
        if ($seizures == 'Yes') {
            $adverseEvent = $this->getAdverseEventByName('Seizures');
            $this->createAefiAdverseEvent($aefi, $adverseEvent);
        }
        if ($abscess == 'Yes') {
            $adverseEvent = $this->getAdverseEventByName('Abscess');
            $this->createAefiAdverseEvent($aefi, $adverseEvent);
        }
        if ($sepsis == 'Yes') {
            $adverseEvent = $this->getAdverseEventByName('Sepsis');
            $this->createAefiAdverseEvent($aefi, $adverseEvent);
        }
        if ($encephalopathy == 'Yes') {
            $adverseEvent = $this->getAdverseEventByName('Encephalopathy');
            $this->createAefiAdverseEvent($aefi, $adverseEvent);
        }
        if ($toxicShockSyndrome == 'Yes') {
            $adverseEvent = $this->getAdverseEventByName('Toxic shock syndrome');
            $this->createAefiAdverseEvent($aefi, $adverseEvent);
        }
        if ($thrombocytopenia == 'Yes') {
            $adverseEvent = $this->getAdverseEventByName('Thrombocytopenia');
            $this->createAefiAdverseEvent($aefi, $adverseEvent);
        }
        if ($anaphylaxis == 'Yes') {
            $adverseEvent = $this->getAdverseEventByName('Anaphylaxis');
            $this->createAefiAdverseEvent($aefi, $adverseEvent);
        }
        if ($fever == 'Yes') {
            $adverseEvent = $this->getAdverseEventByName('Fever');
            $this->createAefiAdverseEvent($aefi, $adverseEvent);
        }
        if ($beyondNearestJoint == 'Yes') {
            $adverseEvent = $this->getAdverseEventByName('Beyond nearest joint');
            $this->createAefiAdverseEvent($aefi, $adverseEvent);
        }
        if ($febrile == 'Yes') {
            $adverseEvent = $this->getAdverseEventByName('Febrile');
            $this->createAefiAdverseEvent($aefi, $adverseEvent);
        }
        if ($afebrile == 'Yes') {
            $adverseEvent = $this->getAdverseEventByName('Afebrile');
            $this->createAefiAdverseEvent($aefi, $adverseEvent);
        }
        if ($other == 'Yes') {
            $adverseEvent = $this->getAdverseEventByName('Other');
            $this->createAefiAdverseEvent($aefi, $adverseEvent);
        }
    }

    private function createAefiAdverseEvent(AEFI $aefi, AdverseEvent $adverseEvent): void
    {
        AEFIAdverseEvent::create([
            'a_e_f_i_id' => $aefi->id,
            'adverse_event_id' => $adverseEvent->id,
        ]);
    }

    private function getAdverseEventByName(string $name): ?AdverseEvent
    {
        return AdverseEvent::where('adverse_event', $name)->first();
    }

    private function getSeverityByName(string $name): ?ADRSeriousReason
    {
        return ADRSeriousReason::where('reason', $name)->first();
    }
}
