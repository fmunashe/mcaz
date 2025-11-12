<?php

namespace App\Http\Ussd\States\Registration;

use App\ClearSession;
use App\Http\Ussd\States\ExitState;
use App\Http\Ussd\States\Welcome;
use App\Models\Client;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use Sparors\Ussd\State;

class RegistrationSuccessful extends State
{
    use ClearSession;

    protected $action = self::PROMPT;

    protected function beforeRendering(): void
    {
        $this->menu->text('Registration Successful you can now log in.')
            ->lineBreak();
        $this->menu->paginateListing([
            'Main Menu'], 1, 2, '. ');
        $this->registerClient();
    }

    protected function afterRendering(string $argument): void
    {
        $this->decision->equal('1', Welcome::class);
        $this->decision->any(ExitState::class);
    }

    protected function registerClient(): void
    {

        Client::query()->firstOrCreate([
            'full_name' => $this->record->get('fullName'),
            'email' => $this->record->get('emailAddress'),
            'phone' => $this->record->get('phoneNumber'),
            'username' => $this->record->get('username'),
            'pin' => Hash::make($this->record->get('pin')),
            'language_id' => $this->record->get('languageId'),
            'role_id' => $this->record->get('roleId'),
            'otp' => Hash::make($this->record->get('registrationOTP')),
            'accepted_terms' => $this->record->get('terms'),
        ]);

        $this->clearSession($this->record->get('sessionId'));

    }
}
