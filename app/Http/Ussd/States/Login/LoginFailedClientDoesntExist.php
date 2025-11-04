<?php

namespace App\Http\Ussd\States\Login;

use App\Http\Ussd\States\ExitState;
use App\Http\Ussd\States\InvalidMenuSelection;
use App\Http\Ussd\States\Welcome;
use Sparors\Ussd\State;

class LoginFailedClientDoesntExist extends State
{
    protected function beforeRendering(): void
    {
        $this->menu->text('It appears you are not yet registered');
        $this->menu->lineBreak();
        $this->menu->paginateListing([
            'Main Menu',
            'Exit'], 1, 2, '. ')
            ->lineBreak();
    }

    protected function afterRendering(string $argument): void
    {
        $this->decision->equal('1', Welcome::class);
        $this->decision->equal('2', ExitState::class);
        $this->decision->any(InvalidMenuSelection::class);
    }
}
