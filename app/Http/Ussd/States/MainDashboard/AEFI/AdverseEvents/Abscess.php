<?php

namespace App\Http\Ussd\States\MainDashboard\AEFI\AdverseEvents;

use Sparors\Ussd\State;

class Abscess extends State
{
    protected function beforeRendering(): void
    {
        $this->menu->line('Abscess');
        $this->menu->paginateListing([
            'Yes',
            'No'
        ], 1, 2, '. ');
    }

    protected function afterRendering(string $argument): void
    {
        if ($argument == '1') {
            $this->record->set('abscess', 'Yes');
            $this->decision->any(Sepsis::class);
        }
        if ($argument == '2') {
            $this->record->set('abscess', 'No');
            $this->decision->any(Sepsis::class);
        }
        $this->decision->any(Abscess::class);
    }
}
