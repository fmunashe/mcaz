<?php

namespace App\Http\Ussd\States;

use App\ClearSession;
use Sparors\Ussd\State;

class ExitState extends State
{
    use ClearSession;
    protected function beforeRendering(): void
    {
        $this->menu->text('Thank you for using our service');
        $this->clearSession($this->record->get('sessionId'));
    }

    protected function afterRendering(string $argument): void
    {
        $this->clearSession($this->record->get('sessionId'));
        $this->decision->any(Welcome::class);
    }
}
