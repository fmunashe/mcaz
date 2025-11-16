<?php

namespace App\Http\Ussd\States\MainDashboard\AEFI;

use Sparors\Ussd\State;

class EmailAddress extends State
{
    protected function beforeRendering(): void
    {
        $this->menu->line('Report email address');
    }

    protected function afterRendering(string $argument): void
    {
        $this->record->set('emailAddress', $argument);
        $this->decision->any(DateOfEventNotification::class);
    }
}
