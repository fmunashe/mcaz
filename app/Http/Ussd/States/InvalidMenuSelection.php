<?php

namespace App\Http\Ussd\States;

use App\ClearSession;
use Sparors\Ussd\State;

class InvalidMenuSelection extends State
{
    use ClearSession;

    protected function beforeRendering(): void
    {
        $this->menu->text('Invalid menu selected. Please try again');
        $this->clearSession($this->record->get('sessionId'));
    }

    protected function afterRendering(string $argument): void
    {
        $this->decision->any(Welcome::class);
    }
}
