<?php

namespace App\Http\Ussd\States\MainDashboard\AEFI;

use App\Http\Ussd\States\MainDashboard\AEFI\Vaccines\VaccineName;
use Sparors\Ussd\State;
use function PHPUnit\Framework\isInt;

class NumberOfVaccinesToCapture extends State
{
    protected function beforeRendering(): void
    {
        $this->menu->line('Number of vaccines to capture eg 5');
    }

    protected function afterRendering(string $argument): void
    {
        if (isInt($argument)) {
            $this->record->set('numberOfVaccinesToCapture', $argument);
            $this->record->set('vaccineCount', 1);
            $this->decision->any(VaccineName::class);
        }
        $this->decision->any(NumberOfVaccinesToCapture::class);
    }
}
