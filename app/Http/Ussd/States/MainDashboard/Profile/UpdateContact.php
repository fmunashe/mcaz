<?php

namespace App\Http\Ussd\States\MainDashboard\Profile;

use App\Events\ContactUpdate;
use App\Events\PinResetEvent;
use App\Http\common\OTPNotificationData;
use App\Http\Ussd\Actions\MainDashboard\Profile\CheckContactUpdateOTP;
use App\Http\Ussd\States\InvalidMenuSelection;
use App\Models\Client;
use App\OTPGeneration;
use Sparors\Ussd\State;

class UpdateContact extends State
{
    use OTPGeneration;
    protected function beforeRendering(): void
    {
        $this->menu->line('Enter New Email');
        $this->menu->paginateListing([
            'Back'], 1, 2, '. ');
    }

    protected function afterRendering(string $argument): void
    {
        $email = $argument;
        $client = Client::query()
            ->where('phone', $this->record->get('phoneNumber'))
            ->first();
        if ($client) {
            $emailUpdateOtp = $this->generateOtp();
            $this->record->set('emailUpdateOtp', $emailUpdateOtp);
            $this->record->set('newEmail', $email);
            $notificationData = new OTPNotificationData();
            $notificationData->otp = $emailUpdateOtp;
            $notificationData->phone = $this->record->get('phoneNumber');
            $notificationData->email = $email;
            $notificationData->name = $client->full_name;
            event(new ContactUpdate($notificationData));
            $this->decision->any(ContactUpdateOtpScreen::class);
        } else {
            $this->decision->any(InvalidMenuSelection::class);
        }
    }
}
