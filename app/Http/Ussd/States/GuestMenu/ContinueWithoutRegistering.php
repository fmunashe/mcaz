<?php

namespace App\Http\Ussd\States\GuestMenu;

use App\Http\Ussd\States\ExitState;
use App\Http\Ussd\States\GuestMenu\Complaints\CustomerComplaint;
use App\Http\Ussd\States\Help\HelpAndSupport;
use App\Http\Ussd\States\InvalidMenuSelection;
use App\Http\Ussd\States\MainDashboard\ADR\ReportAdr;
use App\Http\Ussd\States\MainDashboard\AEFI\ReportAefi;
use App\Http\Ussd\States\MainDashboard\QualityProblemReport\ReportQualityProblem;
use App\Http\Ussd\States\MySubmissions\MySubmissions;
use Sparors\Ussd\State;

class ContinueWithoutRegistering extends State
{
    protected function beforeRendering(): void
    {
        $this->menu->line('Guest Menu');
        $this->menu->paginateListing([
            'Report suspected reaction with a medicine ADR',
            'Report suspected reaction with a vaccine AEFI',
            'Report suspected quality problem with a medicine or vaccine or glove or condom',
            'Submit a complaint',
            'FAQs',
            'Make an enquiry',
            'My submissions',
            'Notifications',
            'Help',
            'Exit'], 1, 11, '. ');
    }

    protected function afterRendering(string $argument): void
    {
        $this->decision->equal('1', ReportAdr::class);
        $this->decision->equal('2', ReportAefi::class);
        $this->decision->equal('3', ReportQualityProblem::class);
        $this->decision->equal('4', CustomerComplaint::class);
        $this->decision->in(['5', '6', '9'], HelpAndSupport::class);
        $this->decision->equal(['7', '8'], MySubmissions::class);
        $this->decision->equal('10', ExitState::class);
        $this->decision->any(InvalidMenuSelection::class);
    }
}
