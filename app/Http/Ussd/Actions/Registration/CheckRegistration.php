<?php

namespace App\Http\Ussd\Actions\Registration;

use App\Http\Ussd\States\Registration\Register;
use App\Http\Ussd\States\Registration\Validation\ClientAlreadyRegistered;
use App\Models\Client;
use Sparors\Ussd\Action;

class CheckRegistration extends Action
{
    public function run(): string
    {
        $client = Client::query()
            ->where('phone', $this->record->get('phoneNumber'))
            ->first();
        if ($client) {
            return ClientAlreadyRegistered::class;
        }
        return Register::class;
    }
}
