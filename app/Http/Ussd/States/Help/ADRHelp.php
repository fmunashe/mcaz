<?php

namespace App\Http\Ussd\States\Help;

use Sparors\Ussd\State;

class ADRHelp extends State
{
    protected function beforeRendering(): void
    {
        $this->menu->line('A harmful or unwanted response to a medicine when taken at normal doses.');
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
        $this->decision->any(ADRHelp::class);
    }
}
