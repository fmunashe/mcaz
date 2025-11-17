<?php

namespace App\Http\Ussd\States\Help;

use App\Http\Ussd\Actions\CheckLoggedIn;
use App\Http\Ussd\States\InvalidMenuSelection;
use App\Http\Ussd\States\Welcome;
use Sparors\Ussd\State;

class HelpAndSupport extends State
{
    protected function beforeRendering(): void
    {
        $this->menu->text('Help and Support');
        $this->menu->lineBreak(2);
        $this->menu->paginateListing([
            'What is Pharmacovigilance',
            'What is an ADR or AEFI or Product defect',
            'How to Report ADR or AEFI or Product defect or complaint',
            'Contact MCAZ Support Tel or Email',
            'Back'], 1, 5, '. ');
    }

    protected function afterRendering(string $argument): void
    {
        $this->decision->equal('1', WhatIsPharmacovigilance::class);
        $this->decision->equal('2', WhatIsAdrAefiProductDefect::class);
        $this->decision->equal('3', HowToReportAdrAefiProductDefectComplaint::class);
        $this->decision->equal('4', ContactMcazSupport::class);
        $this->decision->equal('5', CheckLoggedIn::class);
        $this->decision->any(InvalidMenuSelection::class);
    }
}
