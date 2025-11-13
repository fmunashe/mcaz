<?php

namespace App\Http\Ussd\States\MainDashboard\QualityProblemReport;

use Sparors\Ussd\State;

class BatchNumber extends State
{
    protected function beforeRendering(): void
    {
        $this->menu->line('Batch Number');
    }

    protected function afterRendering(string $argument): void
    {
        $this->record->set('batchNumber', $argument);
        $this->decision->any(ExpiryDate::class);
    }
}
