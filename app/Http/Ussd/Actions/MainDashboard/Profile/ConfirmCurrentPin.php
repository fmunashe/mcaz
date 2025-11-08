<?php

namespace App\Http\Ussd\Actions\MainDashboard\Profile;

use App\Http\Ussd\States\MainDashboard\Profile\ChangePinNewScreen;
use App\Http\Ussd\States\MainDashboard\Profile\IncorrectCurrentPin;
use App\UssdLoggedInUser;
use Illuminate\Support\Facades\Hash;
use Sparors\Ussd\Action;

class ConfirmCurrentPin extends Action
{
    use UssdLoggedInUser;

    public function run(): string
    {
        $currentPin = $this->record->get('currentPin');

        $client = $this->getUserByPhone($this->record->get('phoneNumber'));

        $userPin = $client->pin;
        if (Hash::check($currentPin, $userPin)) {
            return ChangePinNewScreen::class;
        }
        return IncorrectCurrentPin::class;
    }
}
