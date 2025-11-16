<?php

namespace App\Http\Ussd\States\MainDashboard\AEFI;

use Sparors\Ussd\State;

class Institution extends State
{
    protected function beforeRendering(): void
    {
        $this->menu->line('Institution');
    }

    protected function afterRendering(string $argument): void
    {
        $this->record->set('institution', $argument);
        $this->decision->any(Designation::class);
    }
}
