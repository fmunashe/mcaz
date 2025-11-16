<?php

namespace App\Http\Ussd\States\MainDashboard\AEFI;

use Sparors\Ussd\State;

class PregnancyStatus extends State
{
    protected function beforeRendering(): void
    {
        $this->menu->line('Pregnancy status');
        $this->menu->paginateListing([
            'Pregnant',
            'Lactating',
            'Not Pregnant'
        ], 1, 3, '. ');
    }

    protected function afterRendering(string $argument): void
    {
        if ($argument == '1') {
            $this->record->set('pregnancyStatus', 'pregnant');
            $this->decision->any(DateOfBirth::class);
        } elseif ($argument == '2') {
            $this->record->set('pregnancyStatus', 'lactating');
            $this->decision->any(DateOfBirth::class);
        } elseif ($argument == '3') {
            $this->record->set('pregnancyStatus', 'not_pregnant');
            $this->decision->any(DateOfBirth::class);
        }
        $this->decision->any(PregnancyStatus::class);
    }
}
