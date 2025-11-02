<?php

namespace App\Http\Ussd\States;

use Sparors\Ussd\State;

class ContinueWithoutRegistering extends State
{
    protected function beforeRendering(): void
    {
        //
    }

    protected function afterRendering(string $argument): void
    {
        //
    }
}
