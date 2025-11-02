<?php

namespace App\Http\Ussd\States\Registration;

use App\Events\RegistrationOTPEvent;
use App\Http\common\OTPNotificationData;
use App\Http\Ussd\States\ExitState;
use App\OTPGeneration;
use Sparors\Ussd\State;

class TermsAndConditions extends State
{
    use OTPGeneration;

    protected function beforeRendering(): void
    {
        $this->menu->text('Accept Terms & Privacy Policy (For Data Protection Laws)')
            ->lineBreak(2)
            ->paginateListing([
                'Yes',
                'No',
                'Exit'], 1, 5, '. ')
            ->lineBreak(2);
    }

    protected function afterRendering(string $argument): void
    {
        $terms = $argument;
        if ($terms == 1) {
            $this->record->set('terms', $terms);
            $otp = $this->generateOTP();
            $this->record->set('generatedOTP', $otp);
            $notificationData = new OTPNotificationData();
            $notificationData->otp = $otp;
            $notificationData->phone = $this->record->get('phoneNumber');
            $notificationData->email = $this->record->get('emailAddress');
            $notificationData->name = $this->record->get('fullName');

            event(new RegistrationOTPEvent($notificationData));

            $this->decision->any(OTP::class);
        } elseif ($terms == 3) {
            $this->decision->any(ExitState::class);
        } else {
            $this->decision->any(TermsAndConditions::class);
        }
    }
}
