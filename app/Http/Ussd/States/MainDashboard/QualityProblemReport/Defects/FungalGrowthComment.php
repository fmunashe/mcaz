<?php

namespace App\Http\Ussd\States\MainDashboard\QualityProblemReport\Defects;

use Sparors\Ussd\State;

class FungalGrowthComment extends State
{
    protected function beforeRendering(): void
    {
        $this->menu->line('Fungal growth comments');
    }

    protected function afterRendering(string $argument): void
    {
        $this->record->set('fungalGrowthComment', $argument);
        $this->decision->any(SuspectedContamination::class);
    }
}
