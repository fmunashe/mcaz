<?php

namespace App\Http\Ussd\States\MainDashboard\QualityProblemReport\Defects;

use Sparors\Ussd\State;

class PresenceOfForeignMaterialComment extends State
{
    protected function beforeRendering(): void
    {
        $this->menu->line('Presence of foreign material comments');
    }

    protected function afterRendering(string $argument): void
    {
        $this->record->set('presenceOfForeignMaterialComment', $argument);
        $this->decision->any(UnusualOdour::class);
    }
}
