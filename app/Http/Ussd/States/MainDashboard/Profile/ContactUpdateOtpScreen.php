<?php

namespace App\Http\Ussd\States\MainDashboard\Profile;

use App\Http\Ussd\Actions\MainDashboard\Profile\CheckContactUpdateOTP;
use Sparors\Ussd\State;

class ContactUpdateOtpScreen extends State
{
    protected function beforeRendering(): void
    {
        $this->menu->line('Enter OTP sent to new email');
        $this->menu->paginateListing([
            'Back'], 1, 2, '. ');

    }

    protected function afterRendering(string $argument): void
    {
        $otp = $argument;
        $this->record->set('receivedOtp', $otp);
        $this->decision->equal('1', UpdateContact::class);
        $this->decision->any(CheckContactUpdateOTP::class);
    }
}
