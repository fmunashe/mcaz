<?php

namespace App\Http\Ussd\States\MainDashboard\AEFI\AdverseEvents;

use Sparors\Ussd\State;

class Fever extends State
{
    protected function beforeRendering(): void
    {
        $this->menu->line('Fever above 38 degrees');
        $this->menu->paginateListing([
            'Yes',
            'No'
        ], 1, 2, '. ');
    }

    protected function afterRendering(string $argument): void
    {
        if ($argument == '1') {
            $this->record->set('fever', 'Yes');
            $this->decision->any(Other::class);
        }
        if ($argument == '2') {
            $this->record->set('fever', 'No');
            $this->decision->any(Other::class);
        }
        $this->decision->any(Fever::class);
    }
}
