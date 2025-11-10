<?php

namespace App\Http\Ussd\States\Registration\Validation;

use App\Http\Ussd\States\Registration\ConfirmPin;
use Sparors\Ussd\State;

class GeneratePinFailed extends State
{
    protected function beforeRendering(): void
    {
        $this->menu->text('Invalid PIN format. Please enter exactly 4 digits')
            ->lineBreak();
    }

    protected function afterRendering(string $argument): void
    {
        if (!preg_match('/^[0-9]{4}$/', $argument)) {
            $this->decision->any(GeneratePinFailed::class);
        }

        $this->record->set('pin', $argument);
        $this->decision->any(ConfirmPin::class);
    }
}
