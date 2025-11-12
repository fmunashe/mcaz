<?php

namespace App\Http\Ussd\States\MainDashboard\Complaints;

use Sparors\Ussd\State;

class CustomerComplaintOrganisation extends State
{
    protected function beforeRendering(): void
    {
        $this->menu->line('Name of Organisation (if applicable or No to skip)');
    }

    protected function afterRendering(string $argument): void
    {
        $this->record->set('complaintOrganisationName', $argument);
        $this->decision->any(CustomerComplaintDescription::class);
    }
}
