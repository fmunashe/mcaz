<?php

namespace App\Http\Ussd\States\Help;

use Sparors\Ussd\State;

class WhatIsPharmacovigilance extends State
{
    protected function beforeRendering(): void
    {
        $this->menu->line('Pharmacovigilance is the science and activities relating to the detection, assessment, understanding and prevention of adverse effects or any other medicines-related problem. It aims at getting the best outcome from treatment with medicines.');
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
