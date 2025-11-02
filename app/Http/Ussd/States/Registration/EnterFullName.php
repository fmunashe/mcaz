<?php

namespace App\Http\Ussd\States\Registration;

use Sparors\Ussd\State;

class EnterFullName extends State
{
    protected function beforeRendering(): void
    {
        $this->menu->text('Enter Full Name')
            ->lineBreak(2);
    }

    protected function afterRendering(string $argument): void
    {
        // Validate full name (at least 2 characters)
        if (strlen($argument) < 2) {
            $this->menu->text('Invalid name. Please enter a valid name (at least 2 characters)');
            $this->decision->any(EnterFullName::class);
            return;
        }

        $this->record->set('fullName', $argument);
        $this->decision->any(EmailAddress::class);
    }
}
