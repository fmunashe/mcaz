<?php

namespace App\Http\Ussd\States\MainDashboard\AEFI\SeriousReasons;

use Sparors\Ussd\State;

class Death extends State
{
    protected function beforeRendering(): void
    {
        $this->menu->line('Serious reason is death');
        $this->menu->paginateListing([
            'Yes',
            'No'
        ], 1, 2, '. ');
    }

    protected function afterRendering(string $argument): void
    {
        if ($argument == '1') {
            $this->record->set('seriousDeath', 'Yes');
            $this->decision->any(LifeThreatening::class);
        }
        if ($argument == '2') {
            $this->record->set('seriousDeath', 'No');
            $this->decision->any(LifeThreatening::class);
        }
        $this->decision->any(Death::class);
    }
}
