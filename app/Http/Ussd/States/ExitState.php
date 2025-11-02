<?php

namespace App\Http\Ussd\States;

use Sparors\Ussd\State;

class ExitState extends State
{
    protected $action = self::PROMPT;
    protected function beforeRendering(): void
    {
        $this->menu->text('Thank you for using our service');
    }

    protected function afterRendering(string $argument): void
    {
        $this->decision->equal('1', Welcome::class);
    }
}
