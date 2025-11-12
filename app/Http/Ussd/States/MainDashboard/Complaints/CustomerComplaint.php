<?php

namespace App\Http\Ussd\States\MainDashboard\Complaints;

use App\OTPGeneration;
use Sparors\Ussd\State;

class CustomerComplaint extends State
{
    use OTPGeneration;

    protected function beforeRendering(): void
    {
        $this->menu->text('Enter your address or No to skip')
            ->lineBreak();
    }

    protected function afterRendering(string $argument): void
    {
        $this->record->set('complaintAddress', $argument);
        $this->decision->any(CustomerComplaintOrganisation::class);
    }
}
