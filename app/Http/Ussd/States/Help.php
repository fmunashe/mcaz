<?php

namespace App\Http\Ussd\States;

use Sparors\Ussd\State;

class Help extends State
{
    protected function beforeRendering(): void
    {
        $this->menu->text('Help / Support');
        $this->menu->lineBreak(2);
        $this->menu->paginateListing([
            'What is Pharmacovigilance?',
            'What is an ADR/AEFI/ Product defect?',
            'How to Report ADR/AEFI/Product defect/complaint?',
            'Contact MCAZ Support (Tel / Email)',
            'Back'], 1, 5, '. ');
    }

    protected function afterRendering(string $argument): void
    {
        $this->decision->equal('1', WhatIsPharmacovigilance::class);
        $this->decision->equal('2', WhatIsAdrAefiProductDefect::class);
        $this->decision->equal('3', HowToReportAdrAefiProductDefectComplaint::class);
        $this->decision->equal('4', ContactMcazSupport::class);
        $this->decision->equal('5', Welcome::class);
        $this->decision->any(InvalidMenuSelection::class);
    }
}
