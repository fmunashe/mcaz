<?php

namespace App\Http\Ussd\States\MainDashboard\AEFI\Vaccines;

use App\Http\Ussd\Actions\MainDashboard\AEFI\Vaccines\CheckVaccineCount;
use Sparors\Ussd\State;

class CheckDiluent extends State
{
    protected function beforeRendering(): void
    {
        $vaccineCount = $this->record->get('vaccineCount');
        $vaccineName = $this->record->get('vaccineName' . $vaccineCount);
        $this->menu->line('Is there diluent for vaccine ' . $vaccineName);
        $this->menu->paginateListing([
            'Yes',
            'No'
        ], 1, 2, '. ');
    }

    protected function afterRendering(string $argument): void
    {
        if (empty($argument) || !in_array($argument, [1, 2])) {
            $this->decision->any(self::class);
            return;
        }
        if ($argument == '1') {
            $this->decision->any(DiluentBatchNumber::class);
        } else {
            $this->decision->any(CheckVaccineCount::class);
        }
    }
}
