<?php

namespace App\Http\Ussd\States\MainDashboard;

use App\Http\Ussd\States\ExitState;
use App\Http\Ussd\States\Help\HelpAndSupport;
use App\Http\Ussd\States\InvalidMenuSelection;
use App\Http\Ussd\States\MainDashboard\ADR\ReportAdr;
use App\Http\Ussd\States\MainDashboard\AEFI\ReportAefi;
use App\Http\Ussd\States\MainDashboard\Complaints\CustomerComplaint;
use App\Http\Ussd\States\MainDashboard\Profile\MyProfile;
use App\Http\Ussd\States\MainDashboard\QualityProblemReport\ReportQualityProblem;
use App\Http\Ussd\States\MySubmissions\MySubmissions;
use Sparors\Ussd\State;

class Dashboard extends State
{
    protected function beforeRendering(): void
    {
        $this->menu->line('Main Menu');
        $this->menu->paginateListing([
            'Report suspected reaction with a medicine ADR',
            'Report suspected reaction with a vaccine AEFI',
            'Report suspected quality problem with a medicine or vaccine or glove or condom',
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
        $this->decision->equal('4', CustomerComplaint::class);
        $this->decision->in(['5','6', '10'], HelpAndSupport::class);
        $this->decision->in(['7','8'], MySubmissions::class);
        $this->decision->equal('9', MyProfile::class);
        $this->decision->equal('11', ExitState::class);
        $this->decision->any(InvalidMenuSelection::class);
    }
}
