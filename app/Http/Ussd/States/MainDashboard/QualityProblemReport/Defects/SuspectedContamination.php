<?php

namespace App\Http\Ussd\States\MainDashboard\QualityProblemReport\Defects;

use Sparors\Ussd\State;

class SuspectedContamination extends State
{
    protected function beforeRendering(): void
    {
        $this->menu->line('Suspected contamination')
            ->paginateListing([
                'Yes',
                'No'
            ], 1, 3, '. ');
    }

    protected function afterRendering(string $argument): void
    {
        if ($argument == '1') {
            $this->record->set('suspectedContamination', 'Yes');
            $this->decision->any(SuspectedContaminationComments::class);
        } elseif ($argument == '2') {
            $this->record->set('suspectedContamination', 'No');
            $this->record->set('suspectedContaminationComments', null);
            $this->decision->any(ParenteralSolutionLeaks::class);
        } else {
            $this->decision->any(SuspectedContamination::class);
        }
    }
}
