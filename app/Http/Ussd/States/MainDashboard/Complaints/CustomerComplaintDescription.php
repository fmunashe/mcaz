<?php

namespace App\Http\Ussd\States\MainDashboard\Complaints;

use Sparors\Ussd\State;

class CustomerComplaintDescription extends State
{
    protected function beforeRendering(): void
    {
        $this->menu->text('Describe your complaint');
    }

    protected function afterRendering(string $argument): void
    {
        $this->record->set('complaintDescription', $argument);
        $this->decision->any(LocationBeingInvestigated::class);
    }
}
