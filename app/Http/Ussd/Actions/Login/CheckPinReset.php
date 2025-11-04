<?php

namespace App\Http\Ussd\Actions\Login;

use App\Http\Ussd\States\Login\ConfirmNewPin;
use App\Http\Ussd\States\Login\PinSetSuccessfully;
use App\Models\Client;
use Illuminate\Support\Facades\Hash;
use Sparors\Ussd\Action;

class CheckPinReset extends Action
{
    public function run(): string
    {
        $pin = $this->record->get('newPin');
        $confirmPin = $this->record->get('confirmNewPin');
        if ($pin === $confirmPin) {
            $client = Client::query()
                ->where('phone', $this->record->get('phoneNumber'))
                ->first();
            $client->pin = Hash::make($pin);
            $client->save();
            return PinSetSuccessfully::class;
        }
        return ConfirmNewPin::class;
    }
}
