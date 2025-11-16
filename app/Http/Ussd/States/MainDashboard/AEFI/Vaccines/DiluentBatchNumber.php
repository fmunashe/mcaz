<?php

namespace App\Http\Ussd\States\MainDashboard\AEFI\Vaccines;

use Sparors\Ussd\State;

class DiluentBatchNumber extends State
{
    protected function beforeRendering(): void
    {
        $this->menu->line('Diluent batch number');
    }

    protected function afterRendering(string $argument): void
    {
        $count = $this->record->get('vaccineCount');
        $this->record->set('diluentBatchNumber'.$count, $argument);
        $this->decision->any(DiluentExpiryDate::class);
    }
}
