<?php

namespace App\Http\Ussd\States\MainDashboard\AEFI\Vaccines;

use Sparors\Ussd\State;

class Dose extends State
{
    protected function beforeRendering(): void
    {
        $this->menu->line('Dose eg first or second etc');
    }

    protected function afterRendering(string $argument): void
    {
        $count = $this->record->get('vaccineCount');
        $this->record->set('dose'.$count, $argument);
        $this->decision->any(BatchNumber::class);
    }
}
