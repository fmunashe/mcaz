<?php

namespace App\Http\Ussd\States\MainDashboard\AEFI\SeriousReasons;

use Sparors\Ussd\State;

class Hospitalisation extends State
{
    protected function beforeRendering(): void
    {
        $this->menu->line('Hospitalization');
        $this->menu->paginateListing([
            'Yes',
            'No'
        ], 1, 2, '. ');
    }

    protected function afterRendering(string $argument): void
    {
        if ($argument == '1') {
            $this->record->set('hospitalisation', 'Yes');
            $this->decision->any(CongenitalAnomaly::class);
        }
        if ($argument == '2') {
            $this->record->set('hospitalisation', 'No');
            $this->decision->any(CongenitalAnomaly::class);
        }
        $this->decision->any(Hospitalisation::class);
    }
}
