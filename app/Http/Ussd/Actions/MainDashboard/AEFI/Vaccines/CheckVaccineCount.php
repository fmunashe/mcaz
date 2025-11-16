<?php

namespace App\Http\Ussd\Actions\MainDashboard\AEFI\Vaccines;

use App\Http\Ussd\States\MainDashboard\AEFI\AdverseEvents\SevereLocalReaction;
use App\Http\Ussd\States\MainDashboard\AEFI\Vaccines\VaccineName;
use Sparors\Ussd\Action;

class CheckVaccineCount extends Action
{
    public function run(): string
    {
        $count = $this->record->get('vaccineCount');
        $total = $this->record->get('numberOfVaccinesToCapture');
        if ($count != $total) {
            $this->record->set('vaccineCount', $count + 1);
            return VaccineName::class;
        }
        return SevereLocalReaction::class;
    }
}
