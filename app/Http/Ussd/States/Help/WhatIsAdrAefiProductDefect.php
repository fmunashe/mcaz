<?php

namespace App\Http\Ussd\States\Help;

use Sparors\Ussd\State;

class WhatIsAdrAefiProductDefect extends State
{
    protected function beforeRendering(): void
    {
        $this->menu->line('Choose one of the options below');
        $this->menu->paginateListing([
            'Adverse Drug Reactions ADR',
            'Adverse Events Following Immunization AEFI',
            'Product Defects',
            'Back',
        ], 1, 4, '. ');
    }

    protected function afterRendering(string $argument): void
    {
        if (empty($argument) || !in_array($argument, [1, 2, 3, 4])) {
            $this->decision->any(self::class);
            return;
        }
        $this->decision->equal('1', ADRHelp::class);
        $this->decision->equal('2', AEFIHelp::class);
        $this->decision->equal('3', ProductDefectHelp::class);
        $this->decision->equal('4', HelpAndSupport::class);
        $this->decision->any(WhatIsAdrAefiProductDefect::class);
    }
}
