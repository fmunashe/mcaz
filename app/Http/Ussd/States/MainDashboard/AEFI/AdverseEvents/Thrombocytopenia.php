<?php

namespace App\Http\Ussd\States\MainDashboard\AEFI\AdverseEvents;

use Sparors\Ussd\State;

class Thrombocytopenia extends State
{
    protected function beforeRendering(): void
    {
        $this->menu->line('Thrombocytopenia');
        $this->menu->paginateListing([
            'Yes',
            'No'
        ], 1, 2, '. ');
    }

    protected function afterRendering(string $argument): void
    {
        if ($argument == '1') {
            $this->record->set('thrombocytopenia', 'Yes');
            $this->decision->any(Anaphylaxis::class);
        }
        if ($argument == '2') {
            $this->record->set('thrombocytopenia', 'No');
            $this->decision->any(Anaphylaxis::class);
        }
        $this->decision->any(Thrombocytopenia::class);
    }
}
