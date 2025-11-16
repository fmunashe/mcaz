<?php

namespace App\Http\Ussd\States\MainDashboard\AEFI;

use Sparors\Ussd\State;

class InvestigationNeeded extends State
{
    protected function beforeRendering(): void
    {
        $this->menu->line('Investigation needed');
        $this->menu->paginateListing([
            'Yes',
            'No'
        ], 1, 3, '. ');
    }

    protected function afterRendering(string $argument): void
    {
        if ($argument == '1') {
            $this->record->set('investigationNeeded', 'Yes');
            $this->decision->any(DateInvestigationPlanned::class);
        }
        if ($argument == '2') {
            $this->record->set('investigationNeeded', 'No');
            $this->decision->any(Comments::class);
        }
        $this->decision->any(InvestigationNeeded::class);
    }
}
