<?php

namespace App\Http\Ussd\States\MainDashboard\QualityProblemReport\Defects;

use Sparors\Ussd\State;

class UnusualOdour extends State
{
    protected function beforeRendering(): void
    {
        $this->menu->line('Unusual odour');
        $this->menu->paginateListing([
            'Yes',
            'No'
        ], 1, 3, '. ');
    }

    protected function afterRendering(string $argument): void
    {
        if ($argument == '1') {
            $this->record->set('unusualOdour', 'Yes');
            $this->decision->any(UnusualOdourComment::class);
        } elseif ($argument == '2') {
            $this->record->set('unusualOdour', 'No');
            $this->record->set('unusualOdourComment', null);
            $this->decision->any(ColorChanges::class);
        } else {
            $this->decision->any(UnusualOdour::class);
        }
    }
}
