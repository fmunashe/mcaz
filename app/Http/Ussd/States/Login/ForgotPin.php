<?php

namespace App\Http\Ussd\States\Login;

use App\Events\PinResetEvent;
use App\Http\common\OTPNotificationData;
use App\Http\Ussd\States\Registration\Validation\PinResetEmailNotFound;
use App\Models\Client;
use App\OTPGeneration;
use Sparors\Ussd\State;

class ForgotPin extends State
{
    use OTPGeneration;

    protected function beforeRendering(): void
    {
        $this->menu->text('Enter your email address');
        $this->menu->lineBreak(2);
    }

    protected function afterRendering(string $argument): void
    {
        $email = $argument;
        $client = Client::query()
            ->where('email', $email)
            ->first();
        if ($client) {
            $pinResetOtp = $this->generateOtp();
            $this->record->set('pinResetOtp', $pinResetOtp);
            $notificationData = new OTPNotificationData();
            $notificationData->otp = $pinResetOtp;
            $notificationData->phone = $this->record->get('phoneNumber');
            $notificationData->email = $email;
            $notificationData->name = $client->full_name;

            event(new PinResetEvent($notificationData));

            $this->decision->any(NewPin::class);
        } else {
            $this->decision->any(PinResetEmailNotFound::class);
        }
    }
}
