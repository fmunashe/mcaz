<?php

namespace App\Http\Ussd\States\MainDashboard\Profile;

use App\Http\Ussd\States\InvalidMenuSelection;
use Sparors\Ussd\State;

class PrivacyAndDeactivation extends State
{
    protected function beforeRendering(): void
    {
        $this->menu->line('Confirm Profile Deactivation?');
        $this->menu->paginateListing([
            'Confirm',
            'Cancel'], 1, 10, '. ');
    }

    protected function afterRendering(string $argument): void
    {
        $this->decision->equal('1', PrivacyAndDeactivationSuccessful::class);
        $this->decision->equal('2', MyProfile::class);
        $this->decision->any(InvalidMenuSelection::class);
    }
}
