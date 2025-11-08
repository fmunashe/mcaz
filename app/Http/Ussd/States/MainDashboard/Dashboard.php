<?php

namespace App\Http\Ussd\States\MainDashboard;

use App\Http\Ussd\States\ExitState;
use App\Http\Ussd\States\Help\HelpAndSupport;
use App\Http\Ussd\States\InvalidMenuSelection;
use App\Http\Ussd\States\MainDashboard\Profile\MyProfile;
use Sparors\Ussd\State;

class Dashboard extends State
{
    protected function beforeRendering(): void
    {
        $this->menu->text('Main Menu');
        $this->menu->lineBreak(2);
        $this->menu->paginateListing([
            'Report suspected reaction with a medicine (ADR)',
            'Report suspected reaction with a vaccine (AEFI)',
            'Report suspected quality problem with a medicine/vaccine/glove/condom',
            'Submit a complaint',
            'FAQs',
            'Make an enquiry',
            'My submissions',
            'Notifications',
            'My Profile',
            'Help',
            'Exit'], 1, 15, '. ');
    }

    protected function afterRendering(string $argument): void
    {
        $this->decision->equal('1', ReportAdr::class);
        $this->decision->equal('2', ReportAefi::class);
        $this->decision->equal('3', ReportQualityProblem::class);
        $this->decision->equal('4', SubmitComplaint::class);
        $this->decision->in(['5', '10'], HelpAndSupport::class);
        $this->decision->equal('6', MakeEnquiry::class);
        $this->decision->equal('7', MySubmissions::class);
        $this->decision->equal('8', Notifications::class);
        $this->decision->equal('9', MyProfile::class);
        $this->decision->equal('11', ExitState::class);
        $this->decision->any(InvalidMenuSelection::class);
    }
}
