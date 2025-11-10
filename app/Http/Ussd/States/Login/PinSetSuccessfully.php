<?php

namespace App\Http\Ussd\States\Login;

use App\Http\Ussd\States\ExitState;
use App\Http\Ussd\States\InvalidMenuSelection;
use App\Http\Ussd\States\Login;
use App\Http\Ussd\States\Welcome;
use Sparors\Ussd\State;

class PinSetSuccessfully extends State
{
    protected function beforeRendering(): void
    {
        $this->menu->text('Your PIN has been set successfully');
        $this->menu->lineBreak();
        $this->menu->paginateListing([
            'Main Menu',
            'Login',
            'Exit'], 1, 3, '. ');
    }

    protected function afterRendering(string $argument): void
    {
        $this->decision->equal('1', Welcome::class);
        $this->decision->equal('2', Login::class);
        $this->decision->equal('3', ExitState::class);
        $this->decision->any(InvalidMenuSelection::class);
    }
}
