<?php

namespace App\Http\Ussd\States\MainDashboard\Complaints;

use App\Http\Ussd\States\ExitState;
use App\Http\Ussd\States\GuestMenu\ContinueWithoutRegistering;
use App\Http\Ussd\States\InvalidMenuSelection;
use App\Http\Ussd\States\MainDashboard\Dashboard;
use App\UssdLoggedInUser;
use Sparors\Ussd\State;

class ComplaintSuccessfullyLodged extends State
{
    use UssdLoggedInUser;

    protected function beforeRendering(): void
    {
        $this->menu->line('Your complaint has been lodged successfully');
        $this->menu->line('Your reference number is ' . $this->record->get('complaintReference'));
        $this->menu->paginateListing(['Main Menu', 'Exit'], 1, 5, '. ');
    }

    protected function afterRendering(string $argument): void
    {
        if ($this->record->get('isLoggedIn')) {
            $this->decision->equal('1', Dashboard::class);
            $this->decision->equal('2', ExitState::class);
            $this->decision->any(InvalidMenuSelection::class);
        } else {
            $this->decision->equal('1', ContinueWithoutRegistering::class);
            $this->decision->equal('2', ExitState::class);
            $this->decision->any(InvalidMenuSelection::class);
        }
    }
}
