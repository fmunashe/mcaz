<?php

namespace App\Http\Ussd\States\MainDashboard\ADR;

use App\Http\Ussd\States\ExitState;
use App\Http\Ussd\States\GuestMenu\ContinueWithoutRegistering;
use App\Http\Ussd\States\MainDashboard\Dashboard;
use Sparors\Ussd\State;

class AdrReportSuccessful extends State
{
    protected function beforeRendering(): void
    {
        $this->menu->line('ADR report submitted successfully');
        $this->menu->line('Reference Number is ' . $this->record->get('adrReference'));
        $this->menu->paginateListing([
            'Main Dashboard',
            'Submit another ADR',
            'Exit'
        ], 1, 3, '. ');
    }

    protected function afterRendering(string $argument): void
    {
        if ($this->record->get('isLoggedIn')) {
            $this->decision->equal('1', Dashboard::class);
            $this->decision->equal('2', ReportAdr::class);
            $this->decision->equal('3', ExitState::class);
        } else {
            $this->decision->equal('1', ContinueWithoutRegistering::class);
            $this->decision->equal('2', ReportAdr::class);
            $this->decision->equal('3', ExitState::class);
        }
    }
}
