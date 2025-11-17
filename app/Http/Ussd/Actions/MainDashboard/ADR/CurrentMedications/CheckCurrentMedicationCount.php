<?php

namespace App\Http\Ussd\Actions\MainDashboard\ADR\CurrentMedications;

use App\Http\Ussd\States\MainDashboard\ADR\CurrentMedications\BrandName;
use App\Http\Ussd\States\MainDashboard\ADR\RelevantPastDrugTherapy\NumberOfDrugTherapyToCapture;
use Sparors\Ussd\Action;

class CheckCurrentMedicationCount extends Action
{
    public function run(): string
    {
        $count = $this->record->get('medicationCount');
        $total = $this->record->get('numberOfMedicationsToCapture');
        if ($count != $total) {
            $this->record->set('medicationCount', $count + 1);
            return BrandName::class;
        }
        return NumberOfDrugTherapyToCapture::class;
    }
}
