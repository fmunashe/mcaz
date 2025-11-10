<?php

namespace App\Http\Ussd\States\Registration;

use App\Http\Ussd\States\Registration\Validation\EmailValidationFailed;
use Sparors\Ussd\State;

class EmailAddress extends State
{
    protected function beforeRendering(): void
    {
        $this->menu->text('Enter Email Address')
            ->lineBreak();
    }

    protected function afterRendering(string $argument): void
    {
        // Validate email address
        if (!filter_var($argument, FILTER_VALIDATE_EMAIL)) {
            $this->decision->any(EmailValidationFailed::class);
        }

        $this->record->set('emailAddress', $argument);
        $this->decision->any(Username::class);
    }
}
