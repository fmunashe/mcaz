<?php

namespace App\Http\Ussd\States\MainDashboard\QualityProblemReport\Defects;

use Sparors\Ussd\State;

class WrongLabelComment extends State
{
    protected function beforeRendering(): void
    {
        $this->menu->line('Wrong label comment');
    }

    protected function afterRendering(string $argument): void
    {
        $this->record->set('wrongLabelComment', $argument);
        $this->decision->any(WrongPackaging::class);
    }
}
