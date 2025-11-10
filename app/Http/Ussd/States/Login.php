<?php

namespace App\Http\Ussd\States;

use App\Http\Ussd\States\Login\LoginFailedClientDoesntExist;
use App\Http\Ussd\States\Login\LoginFailedIncorrectPin;
use App\Http\Ussd\States\MainDashboard\Dashboard;
use App\Models\Client;
use Illuminate\Support\Facades\Hash;
use Sparors\Ussd\State;

class Login extends State
{
    protected function beforeRendering(): void
    {
        $this->menu->text('Enter PIN');
    }

    protected function afterRendering(string $argument): void
    {
        $pin = $argument;
        $client = Client::query()
            ->where('phone', $this->record->get('phoneNumber'))
            ->first();
        if ($client) {
            if (Hash::check($pin, $client->pin)) {
                $this->record->set('isLoggedIn', true);
                $this->decision->any(Dashboard::class);
            } else {
                $this->decision->any(LoginFailedIncorrectPin::class);
            }
        } else {
            $this->decision->any(LoginFailedClientDoesntExist::class);
        }
    }
}
