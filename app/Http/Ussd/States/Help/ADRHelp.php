<?php

namespace App\Http\Ussd\States\Help;

use Sparors\Ussd\State;

class ADRHelp extends State
{
    protected function beforeRendering(): void
    {
        $this->menu->line('Any untoward medical occurrence which follows immunization and which does not necessarily have a causal relationship with the usage of the vaccine. The adverse event may be any unfavorable or unintended sign, abnormal laboratory finding symptom or disease.');
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
