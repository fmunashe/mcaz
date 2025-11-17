<?php

namespace App\Http\Ussd\States\MainDashboard\AEFI\SeriousReasons;

use Sparors\Ussd\State;

class Disability extends State
{
    protected function beforeRendering(): void
    {
        $this->menu->line('Is reason for seriousness disabling');
        $this->menu->paginateListing([
            'Yes',
            'No'
        ], 1, 2, '. ');
    }

    protected function afterRendering(string $argument): void
    {
        if ($argument == '1') {
            $this->record->set('seriousDisability', 'Yes');
            $this->decision->any(Hospitalisation::class);
        }
        if ($argument == '2') {
            $this->record->set('seriousDisability', 'No');
            $this->decision->any(Hospitalisation::class);
        }
        $this->decision->any(Disability::class);
    }
}
