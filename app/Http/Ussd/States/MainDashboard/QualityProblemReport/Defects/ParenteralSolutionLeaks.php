<?php

namespace App\Http\Ussd\States\MainDashboard\QualityProblemReport\Defects;

use Sparors\Ussd\State;

class ParenteralSolutionLeaks extends State
{
    protected function beforeRendering(): void
    {
        $this->menu->line('Parenteral solution leaks')
            ->paginateListing([
                'Yes',
                'No'
            ], 1, 3, '. ');
    }

    protected function afterRendering(string $argument): void
    {
        if ($argument == '1') {
            $this->record->set('parenteralSolutionLeaks', 'Yes');
            $this->decision->any(ParenteralSolutionLeaksComment::class);
        } elseif ($argument == '2') {
            $this->record->set('parenteralSolutionLeaks', 'No');
            $this->record->set('parenteralSolutionLeaksComment', null);
            $this->decision->any(ParticulateMatter::class);
        } else {
            $this->decision->any(ParenteralSolutionLeaks::class);
        }
    }
}
