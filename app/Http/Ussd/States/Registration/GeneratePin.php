<?php

namespace App\Http\Ussd\States\Registration;

use App\Http\Ussd\States\Registration\Validation\GeneratePinFailed;
use Sparors\Ussd\State;

class GeneratePin extends State
{
    protected function beforeRendering(): void
    {
        $this->menu->text('Create 4-digit PIN')
            ->lineBreak();
    }

    protected function afterRendering(string $argument): void
    {
        // Validate that PIN is exactly 4 digits
        if (!preg_match('/^[0-9]{4}$/', $argument)) {
            $this->decision->any(GeneratePinFailed::class);
        }

        $this->record->set('pin', $argument);
        $this->decision->any(ConfirmPin::class);
    }
}
