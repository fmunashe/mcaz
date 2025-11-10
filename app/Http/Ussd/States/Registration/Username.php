<?php

namespace App\Http\Ussd\States\Registration;

use Sparors\Ussd\State;

class Username extends State
{
    protected function beforeRendering(): void
    {
        $this->menu->text('Enter Username')
            ->lineBreak();
    }

    protected function afterRendering(string $argument): void
    {
        $this->record->set('username', $argument);
        $this->decision->any(GeneratePin::class);
    }
}
