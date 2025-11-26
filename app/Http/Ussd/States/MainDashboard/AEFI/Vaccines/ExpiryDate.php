<?php

namespace App\Http\Ussd\States\MainDashboard\AEFI\Vaccines;

use Sparors\Ussd\State;

class ExpiryDate extends State
{
    protected function beforeRendering(): void
    {
        $this->menu->line('Expiry date');
    }

    protected function afterRendering(string $argument): void
    {
        $count = $this->record->get('vaccineCount');
        $this->record->set('expiryDate'.$count, $argument);
        $this->decision->any(CheckDiluent::class);
    }
}
