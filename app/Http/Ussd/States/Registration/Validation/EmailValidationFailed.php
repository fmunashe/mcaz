<?php

namespace App\Http\Ussd\States\Registration\Validation;

use App\Http\Ussd\States\Registration\Username;
use Sparors\Ussd\State;

class EmailValidationFailed extends State
{
    protected function beforeRendering(): void
    {
        $this->menu->text('Invalid email address. Please enter a valid email')
            ->lineBreak(2);
    }

    protected function afterRendering(string $argument): void
    {
        if (!filter_var($argument, FILTER_VALIDATE_EMAIL)) {
            $this->decision->any(EmailValidationFailed::class);
        }

        $this->record->set('emailAddress', $argument);
        $this->decision->any(Username::class);
    }
}
