<?php

namespace App\Http\Ussd\States\Help;

use Sparors\Ussd\State;

class WhatIsPharmacovigilance extends State
{
    protected function beforeRendering(): void
    {
        $this->menu->line('Pharmacovigilance is the monitoring and evaluation of drug side effects to ensure medicines remain safe and effective after they reach the market');
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
        $this->decision->equal('1', HelpAndSupport::class);
        $this->decision->any(WhatIsPharmacovigilance::class);
    }
}
