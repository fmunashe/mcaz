<?php

namespace App\Http\Ussd\States\Login;

use App\Http\Ussd\States\InvalidMenuSelection;
use App\Http\Ussd\States\Login;
use Sparors\Ussd\State;

class LoginFailedIncorrectPin extends State
{
    protected function beforeRendering(): void
    {
        $this->menu->text('Invalid PIN. Please try again');
        $this->menu->lineBreak(2)
            ->paginateListing([
                'Try again',
                'Forgot Pin'], 1, 2, '. ');
    }

    protected function afterRendering(string $argument): void
    {
        $this->decision->equal('1', Login::class);
        $this->decision->equal('2', ForgotPin::class);
        $this->decision->any(InvalidMenuSelection::class);

    }
}
