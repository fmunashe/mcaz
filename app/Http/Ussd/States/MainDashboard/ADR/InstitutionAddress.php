<?php

namespace App\Http\Ussd\States\MainDashboard\ADR;

use App\Models\ADR;
use App\Models\AdverseReaction;
use App\Models\CurrentMedication;
use App\Models\RelevantMedicalHistory;
use App\Models\RelevantPastDrugTherapy;
use App\OTPGeneration;
use App\UssdLoggedInUser;
use Carbon\Carbon;
use Sparors\Ussd\State;

class InstitutionAddress extends State
{
    use OTPGeneration;
    use UssdLoggedInUser;

    protected function beforeRendering(): void
    {
        $this->menu->line('Enter institution address');
    }

    protected function afterRendering(string $argument): void
    {
        if (empty($argument)) {
            $this->decision->any(self::class);
            return;
        }
        $this->record->set('institutionAddress', $argument);
        $this->submitAdrReport();
        $this->decision->any(AdrReportSuccessful::class);
    }

    private function submitAdrReport(): void
    {
        $reference = $this->generateReferenceNumber();
        $this->record->set('adrReference', $reference);

        $patientName = $this->record->get('patientName');
        $patientDob = $this->record->get('dob');
//        $age = $this->record->get('age');
        $hospitalName = $this->record->get('hospitalName');
        $hospitalNumber = $this->record->get('hospitalNumber');
        $vctNumber = $this->record->get('vctNumber');
        $weight = $this->record->get('weight');
        $height = $this->record->get('height');
        $genderId = $this->record->get('genderId');
        $reportedBy = $this->record->get('reporterFullName');
        $designation = $this->record->get('reporterDesignation');
        $reporterEmail = $this->record->get('reporterEmail');
        $reporterPhoneNumber = $this->record->get('reporterPhoneNumber');
        $institutionName = $this->record->get('institutionName');
        $institutionAddress = $this->record->get('institutionAddress');
        $client = $this->getUserByPhone($this->record->get('phoneNumber'));
        if ($client) {
            $this->record->set('clientId', $client->id);
        }

        $birth = Carbon::createFromFormat('Y-m-d', $patientDob);
        $today = Carbon::now();

        $age = $birth->diffInYears($today);

        $adr = ADR::create([
            'client_id' => $this->record->get('clientId'),
            'mcaz_reference_number' => $reference,
            'patient_initials' => $patientName,
            'dob' => $patientDob,
            'age' => $age,
            'hospital_name' => $hospitalName,
            'hospital_number' => $hospitalNumber,
            'vct_or_tb_number' => $vctNumber,
            'weight' => $weight,
            'height' => $height,
            'gender_id' => $genderId,
            'reported_by' => $reportedBy,
            'designation' => $designation,
            'email_address' => $reporterEmail,
            'phone_number' => $reporterPhoneNumber,
            'institution_name' => $institutionName,
            'institution_address' => $institutionAddress
        ]);
        $this->submitCurrentMedications($adr);
        $this->submitDrugTherapies($adr);
        $this->submitMedicalHistory($adr);
        $this->submitAdverseReactions($adr);


    }

    private function submitCurrentMedications(ADR $adr): void
    {
        $total = $this->record->get('medicationCount');
        for ($i = 1; $i <= $total; $i++) {
            $brandName = $this->record->get('brandName' . $i);
            $batchNumber = $this->record->get('batchNumber' . $i);
            $dose = $this->record->get('dose' . $i);
            $frequency = $this->record->get('frequency' . $i);
            $startDate = $this->record->get('dateStarted' . $i);
            $endDate = $this->record->get('dateStopped' . $i);
            $suspectedMedication = $this->record->get('suspectedMedication' . $i);
            $administrationMethod = $this->record->get('administrationMethod' . $i);

            CurrentMedication::create([
                'a_d_r_id' => $adr->id,
                'brand_name' => $brandName,
                'batch_number' => $batchNumber,
                'dose' => $dose,
                'frequency' => $frequency,
                'medication_administration_method' => $administrationMethod,
                'date_started' => $startDate,
                'date_stopped' => $endDate,
                'suspected_medicine' => $suspectedMedication
            ]);
        }
    }

    private function submitDrugTherapies(ADR $adr): void
    {
        $total = $this->record->get('drugTherapyCount');
        for ($i = 1; $i <= $total; $i++) {
            $brandName = $this->record->get('drugTherapyBrandName' . $i);
            $batchNumber = $this->record->get('drugTherapyBatchNumber' . $i);
            $dose = $this->record->get('drugTherapyDose' . $i);
            $frequency = $this->record->get('drugTherapyFrequency' . $i);
            $startDate = $this->record->get('drugTherapyDateStarted' . $i);
            $endDate = $this->record->get('drugTherapyDateStopped' . $i);
            $suspectedMedication = $this->record->get('drugTherapySuspectedMedication' . $i);

            RelevantPastDrugTherapy::create([
                'a_d_r_id' => $adr->id,
                'brand_name' => $brandName,
                'batch_number' => $batchNumber,
                'dose' => $dose,
                'frequency' => $frequency,
                'date_started' => $startDate,
                'date_stopped' => $endDate,
                'suspected_medicine' => $suspectedMedication
            ]);
        }
    }

    private function submitMedicalHistory(ADR $adr): void
    {
        $AdrLabTestResults = $this->record->get('AdrLabTestResults');
        $adrActionTaken = $this->record->get('adrActionTaken');
        $adrPastMedicalHistoryOutcomeId = $this->record->get('adrPastMedicalHistoryOutcomeId');

        RelevantMedicalHistory::create([
            'a_d_r_id' => $adr->id,
            'lab_test_results' => $AdrLabTestResults,
            'action_taken_id' => $adrActionTaken,
            'a_d_r_outcome_id' => $adrPastMedicalHistoryOutcomeId,
            'relevant_medical_history' => $this->record->get('adrRelevantMedicalHistory'),
            'previous_illness' => $this->record->get('adrPreviousIllness')
        ]);

    }

    private function submitAdverseReactions(ADR $adr): void
    {
        $dateOfOnset = $this->record->get('dateOfOnset');
        $durationId = $this->record->get('durationId');
        $durationNumber = $this->record->get('durationNumber');
        $description = $this->record->get('description');
        $adrSerious = $this->record->get('adrSerious');
        $reasonForSeriousness = $this->record->get('reasonForSeriousness');

        AdverseReaction::create([
            'a_d_r_id' => $adr->id,
            'onset_date' => $dateOfOnset,
            'duration_id' => $durationId,
            'duration' => $durationNumber,
            'description' => $description,
            'serious' => $adrSerious,
            'a_d_r_serious_reason_id' => $reasonForSeriousness
        ]);
    }


}
