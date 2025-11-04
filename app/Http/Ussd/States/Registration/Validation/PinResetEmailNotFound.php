<?php

namespace App\Http\Ussd\States\Registration\Validation;

use App\Http\Ussd\States\InvalidMenuSelection;
use App\Http\Ussd\States\Login\ForgotPin;
use App\Http\Ussd\States\Welcome;
use Sparors\Ussd\State;

class PinResetEmailNotFound extends State
{
    protected function beforeRendering(): void
    {
        $this->menu->text('Email address entered not found.');
        $this->menu->lineBreak(2)
            ->paginateListing([
                'Try again',
                'Main Menu'], 1, 2, '. ');
    }

    protected function afterRendering(string $argument): void
    {
        $this->decision->equal('1', ForgotPin::class);
        $this->decision->equal('2', Welcome::class);
        $this->decision->any(InvalidMenuSelection::class);
    }
}
