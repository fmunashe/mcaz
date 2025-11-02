<?php

namespace App\Http\Ussd\States\Registration\Validation;

use App\Http\Ussd\States\Registration\LanguageSelection;
use Illuminate\Support\Facades\Log;
use Sparors\Ussd\State;

class ConfirmPinFailed extends State
{
    protected function beforeRendering(): void
    {
        $this->menu->text('PIN does not match. Please try again')
            ->lineBreak(2);
    }

    protected function afterRendering(string $argument): void
    {
        $pin = $this->record->get('pin');
        $confirmPin = $argument;
        if ($pin != $confirmPin) {
            $this->decision->any(ConfirmPinFailed::class);
        } else {
            $this->record->set('confirmPin', $argument);
            Log::info("role is {$this->record->get('roleName')}");
            Log::info("name is {$this->record->get('fullName')}");
            Log::info("phone is {$this->record->get('phoneNumber')}");
            Log::info("email is {$this->record->get('emailAddress')}");
            Log::info("Username is {$this->record->get('username')}");
            Log::info("pin is {$this->record->get('pin')}");
            Log::info("confirmPin is {$this->record->get('confirmPin')}");
            $this->decision->any(LanguageSelection::class);
        }
    }
}
