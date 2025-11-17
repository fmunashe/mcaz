<?php

namespace App\Http\Ussd\States\Help;

use Sparors\Ussd\State;

class HowToReportAdrAefiProductDefectComplaint extends State
{
    protected function beforeRendering(): void
    {
        $this->menu->line('Report ADR AEFI product defects or complaints to your health worker or pharmacy or the national medicines authority hotline or reporting app');
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
        $this->decision->any(HowToReportAdrAefiProductDefectComplaint::class);
    }
}
