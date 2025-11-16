<?php

namespace App\Http\Ussd\States\MainDashboard\AEFI;

use App\Http\Ussd\States\ExitState;
use App\Http\Ussd\States\GuestMenu\ContinueWithoutRegistering;
use App\Http\Ussd\States\MainDashboard\Dashboard;
use Sparors\Ussd\State;

class AEFIReportSuccessful extends State
{
    protected function beforeRendering(): void
    {
        $this->menu->line('AEFI record submitted successfully');
        $this->menu->paginateListing([
            'Main Dashboard',
            'Report another AEFI',
            'Exit'
        ], 1, 3, '. ');
    }

    protected function afterRendering(string $argument): void
    {
        if ($this->record->get('isLoggedIn')) {
            $this->decision->equal('1', Dashboard::class);
            $this->decision->equal('2', ReportAefi::class);
            $this->decision->equal('3', ExitState::class);
        } else {
            $this->decision->equal('1', ContinueWithoutRegistering::class);
            $this->decision->equal('2', ReportAefi::class);
            $this->decision->equal('3', ExitState::class);
        }
    }
}
