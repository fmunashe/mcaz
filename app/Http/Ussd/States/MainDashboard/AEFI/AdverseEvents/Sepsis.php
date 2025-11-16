<?php

namespace App\Http\Ussd\States\MainDashboard\AEFI\AdverseEvents;

use Sparors\Ussd\State;

class Sepsis extends State
{
    protected function beforeRendering(): void
    {
        $this->menu->line('Sepsis');
        $this->menu->paginateListing([
            'Yes',
            'No'
        ], 1, 2, '. ');
    }

    protected function afterRendering(string $argument): void
    {
        if ($argument == '1') {
            $this->record->set('sepsis', 'Yes');
            $this->decision->any(Encephalopathy::class);
        }
        if ($argument == '2') {
            $this->record->set('sepsis', 'No');
            $this->decision->any(Encephalopathy::class);
        }
        $this->decision->any(Sepsis::class);
    }
}
