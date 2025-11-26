<?php

namespace App\Http\Ussd\States\MainDashboard\AEFI;

use App\Http\Ussd\States\MainDashboard\AEFI\Outcome\Outcome;
use App\Http\Ussd\States\MainDashboard\AEFI\SeriousReasons\Death;
use Sparors\Ussd\State;

class Serious extends State
{
    protected function beforeRendering(): void
    {
        $this->menu->line('Serious');
        $this->menu->paginateListing([
            'Yes',
            'No'
        ], 1, 2, '. ');
    }

    protected function afterRendering(string $argument): void
    {
        if ($argument == '1') {
            $this->record->set('serious', 'Yes');
            $this->decision->any(Death::class);
        }
        if ($argument == '2') {
            $this->record->set('serious', 'No');
            $this->decision->any(Outcome::class);
        }
        $this->decision->any(Serious::class);
    }
}
