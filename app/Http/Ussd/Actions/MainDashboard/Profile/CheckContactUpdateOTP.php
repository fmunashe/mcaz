<?php

namespace App\Http\Ussd\Actions\MainDashboard\Profile;

use App\Http\Ussd\States\MainDashboard\Profile\ContactUpdateOtpScreen;
use App\Http\Ussd\States\MainDashboard\Profile\ContactUpdateSuccessful;
use App\Models\Client;
use Sparors\Ussd\Action;

class CheckContactUpdateOTP extends Action
{
    public function run(): string
    {
        $otp = $this->record->get('emailUpdateOtp');
        $userOtp = $this->record->get('receivedOtp');
        if ($otp == $userOtp) {
            $client = Client::query()
                ->where('phone', $this->record->get('phoneNumber'))
                ->first();
            $client->email = $this->record->get('newEmail');
            $client->save();
            return ContactUpdateSuccessful::class;
        }
        return ContactUpdateOtpScreen::class;
    }
}
