<?php

namespace App\Http\Ussd\States\Help;

use Sparors\Ussd\State;

class AEFIHelp extends State
{
    protected function beforeRendering(): void
    {
        $this->menu->line('Any unexpected medical event occurring after a vaccine not always caused by it');
        $this->menu->paginateListing([
            'Back',
        ], 1, 1, '. ');
    }

    protected function afterRendering(string $argument): void
    {
        if (empty($argument) || $argument != 1) {
            $this->decision->any(self::class);
            return;
        }
        $this->decision->equal('1', WhatIsAdrAefiProductDefect::class);
        $this->decision->any(AEFIHelp::class);
    }
}
