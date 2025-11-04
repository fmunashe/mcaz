<?php

namespace App\Http\Ussd\States\Login;

use Sparors\Ussd\State;

class NewPin extends State
{
    protected function beforeRendering(): void
    {
        $this->menu->text('Enter your new PIN');
        $this->menu->lineBreak(2);
    }

    protected function afterRendering(string $argument): void
    {
        $pin = $argument;
        $this->record->set('newPin', $pin);
        $this->decision->any(ConfirmNewPin::class);
    }
}
