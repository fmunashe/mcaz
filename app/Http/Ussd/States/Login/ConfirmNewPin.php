<?php

namespace App\Http\Ussd\States\Login;

use App\Http\Ussd\Actions\Login\CheckPinReset;
use Sparors\Ussd\State;

class ConfirmNewPin extends State
{
    protected function beforeRendering(): void
    {
        $this->menu->text('Confirm your new PIN');
    }

    protected function afterRendering(string $argument): void
    {

        $pin = $argument;
        $this->record->set('confirmNewPin', $pin);
        $this->decision->any(CheckPinReset::class);
    }
}
