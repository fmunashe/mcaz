<?php

namespace App\Http\Ussd\States\MainDashboard\AEFI\Vaccines;

use Sparors\Ussd\State;

class BatchNumber extends State
{
    protected function beforeRendering(): void
    {
        $this->menu->line('Batch number');
    }

    protected function afterRendering(string $argument): void
    {
        $count = $this->record->get('vaccineCount');
        $this->record->set('batchNumber'.$count, $argument);
        $this->decision->any(ExpiryDate::class);
    }
}
