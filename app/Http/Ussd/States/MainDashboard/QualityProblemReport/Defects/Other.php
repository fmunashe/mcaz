<?php

namespace App\Http\Ussd\States\MainDashboard\QualityProblemReport\Defects;

use App\Http\Ussd\States\MainDashboard\QualityProblemReport\ReportQualityProblemSuccessful;
use Sparors\Ussd\State;

class Other extends State
{
    protected function beforeRendering(): void
    {
        $this->menu->line('Other')
            ->paginateListing([
                'Yes',
                'No'
            ], 1, 3, '. ');
    }

    protected function afterRendering(string $argument): void
    {
        if ($argument == '1') {
            $this->record->set('other', 'Yes');
            $this->decision->any(OtherComments::class);
        } elseif ($argument == '2') {
            $this->record->set('other', 'No');
            $this->record->set('otherComment', null);
            $this->decision->any(ReportQualityProblemSuccessful::class);
        } else {
            $this->decision->any(Other::class);
        }
    }
}
