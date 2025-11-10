<?php

namespace App\Http\Ussd\States\Registration;

use Sparors\Ussd\State;

class OTP extends State
{
    protected function beforeRendering(): void
    {
        $this->menu->text('Enter OTP ( that was sent via SMS or Email)')
            ->lineBreak();
    }

    protected function afterRendering(string $argument): void
    {
        $otp = $argument;
        //check if valid otp
        if ($otp != $this->record->get('generatedOTP')) {
            $this->decision->any(OTP::class);
        } else {
            $this->record->set('registrationOTP', $otp);
            $this->decision->any(RegistrationSuccessful::class);
        }
    }
}
