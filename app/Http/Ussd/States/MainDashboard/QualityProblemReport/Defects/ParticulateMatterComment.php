<?php

namespace App\Http\Ussd\States\MainDashboard\QualityProblemReport\Defects;

use Sparors\Ussd\State;

class ParticulateMatterComment extends State
{
    protected function beforeRendering(): void
    {
        $this->menu->line('Particulate matter comments');
    }

    protected function afterRendering(string $argument): void
    {
        $this->record->set('particulateMatterComment', $argument);
        $this->decision->any(Discoloration::class);
    }
}
