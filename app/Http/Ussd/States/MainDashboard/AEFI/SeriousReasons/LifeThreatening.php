<?php

namespace App\Http\Ussd\States\MainDashboard\AEFI\SeriousReasons;

use Sparors\Ussd\State;

class LifeThreatening extends State
{
    protected function beforeRendering(): void
    {
        $this->menu->line('Is reason for seriousness life threatening');
        $this->menu->paginateListing([
            'Yes',
            'No'
        ], 1, 2, '. ');
    }

    protected function afterRendering(string $argument): void
    {
        if ($argument == '1') {
            $this->record->set('seriousLifeThreatening', 'Yes');
            $this->decision->any(Disability::class);
        }
        if ($argument == '2') {
            $this->record->set('seriousLifeThreatening', 'No');
            $this->decision->any(Disability::class);
        }
        $this->decision->any(LifeThreatening::class);
    }
}
