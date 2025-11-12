<?php

namespace App\Http\Ussd\States\Registration\Validation;

use App\Http\Ussd\States\Registration\LanguageSelection;
use Sparors\Ussd\State;

class ConfirmPinFailed extends State
{
    protected function beforeRendering(): void
    {
        $this->menu->text('PIN does not match. Please try again')
            ->lineBreak();
    }

    protected function afterRendering(string $argument): void
    {
        $pin = $this->record->get('pin');
        $confirmPin = $argument;
        if ($pin != $confirmPin) {
            $this->decision->any(ConfirmPinFailed::class);
        } else {
            $this->record->set('confirmPin', $argument);
            $this->decision->any(LanguageSelection::class);
        }
    }
}
