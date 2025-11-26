<?php

namespace App\Http\Ussd\Actions\MainDashboard\ADR\RelevantPastDrugTherapy;

use App\Http\Ussd\States\MainDashboard\ADR\MedicalHistory\RelevantMedicalHistory;
use App\Http\Ussd\States\MainDashboard\ADR\RelevantPastDrugTherapy\BrandName;
use Sparors\Ussd\Action;

class CheckDrugTherapyCount extends Action
{
    public function run(): string
    {
        $count = $this->record->get('drugTherapyCount');
        $total = $this->record->get('numberOfDrugTherapyToCapture');
        if ($count != $total) {
            $this->record->set('drugTherapyCount', $count + 1);
            return BrandName::class;
        }
        return RelevantMedicalHistory::class;
    }
}
