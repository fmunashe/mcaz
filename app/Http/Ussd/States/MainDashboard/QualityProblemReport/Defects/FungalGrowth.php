<?php

namespace App\Http\Ussd\States\MainDashboard\QualityProblemReport\Defects;

use Sparors\Ussd\State;

class FungalGrowth extends State
{
    protected function beforeRendering(): void
    {
        $this->menu->line('Fungal growth');
        $this->menu->paginateListing([
            'Yes',
            'No'
        ], 1, 3, '. ');
    }

    protected function afterRendering(string $argument): void
    {
        if ($argument == '1') {
            $this->record->set('fungalGrowth', 'Yes');
            $this->decision->any(FungalGrowthComment::class);
        } elseif ($argument == '2') {
            $this->record->set('fungalGrowth', 'No');
            $this->record->set('fungalGrowthComment', null);
            $this->decision->any(SuspectedContamination::class);
        } else {
            $this->decision->any(FungalGrowth::class);
        }
    }
}
