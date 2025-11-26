<?php

namespace App\Http\Ussd\States\MainDashboard\QualityProblemReport;

use Sparors\Ussd\State;

class DateProblemObserved extends State
{
    protected function beforeRendering(): void
    {
        $this->menu->line('Date Problem Occurred or Observed');
    }

    protected function afterRendering(string $argument): void
    {
        $this->record->set('dateProblemObserved', $argument);
        $this->decision->any(ProductAvailableForExamination::class);
    }
}
