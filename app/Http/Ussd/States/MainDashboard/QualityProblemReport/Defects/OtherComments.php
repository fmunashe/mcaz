<?php

namespace App\Http\Ussd\States\MainDashboard\QualityProblemReport\Defects;

use App\Http\Ussd\States\MainDashboard\QualityProblemReport\ReportQualityProblemSuccessful;
use Sparors\Ussd\State;

class OtherComments extends State
{
    protected function beforeRendering(): void
    {
        $this->menu->line('If other specify and add comment');
    }

    protected function afterRendering(string $argument): void
    {
        $this->record->set('otherComment', $argument);
        $this->decision->any(ReportQualityProblemSuccessful::class);
    }
}
