<?php

namespace App\Http\Ussd\States\MainDashboard\AEFI\SeriousReasons;

use Sparors\Ussd\State;

class CongenitalAnomaly extends State
{
    protected function beforeRendering(): void
    {
        $this->menu->line('Is reason for seriousness congenital anomaly');
        $this->menu->paginateListing([
            'Yes',
            'No'
        ], 1, 2, '. ');
    }

    protected function afterRendering(string $argument): void
    {
        if ($argument == '1') {
            $this->record->set('congenitalAnomaly', 'Yes');
            $this->decision->any(Other::class);
        }
        if ($argument == '2') {
            $this->record->set('congenitalAnomaly', 'No');
            $this->decision->any(Other::class);
        }
        $this->decision->any(CongenitalAnomaly::class);
    }
}
