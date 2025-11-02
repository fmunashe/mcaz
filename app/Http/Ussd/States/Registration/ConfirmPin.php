<?php

namespace App\Http\Ussd\States\Registration;

use App\Http\Ussd\States\Registration\Validation\ConfirmPinFailed;
use Illuminate\Support\Facades\Log;
use Sparors\Ussd\State;

class ConfirmPin extends State
{
    protected function beforeRendering(): void
    {
        $this->menu->text('Confirm PIN')
            ->lineBreak(2);
    }

    protected function afterRendering(string $argument): void
    {
        $pin = $this->record->get('pin');
        $confirmPin = $argument;
        if ($pin!=$confirmPin){
            $this->decision->any(ConfirmPinFailed::class);
        }else{
            $this->record->set('confirmPin', $argument);
            $this->decision->any(LanguageSelection::class);
        }

    }
}
