<?php

namespace App\Http\Ussd\States\MainDashboard\QualityProblemReport\Defects;

use Sparors\Ussd\State;

class ColorChanges extends State
{
    protected function beforeRendering(): void
    {
        $this->menu->line('Color changes');
        $this->menu->paginateListing([
            'Yes',
            'No'
        ], 1, 3, '. ');
    }

    protected function afterRendering(string $argument): void
    {
        if ($argument == '1') {
            $this->record->set('colorChanges', 'Yes');
            $this->decision->any(ColorChangesComment::class);
        } elseif ($argument == '2') {
            $this->record->set('colorChanges', 'No');
            $this->record->set('colorChangesComment', null);
            $this->decision->any(FungalGrowth::class);
        } else {
            $this->decision->any(ColorChanges::class);
        }
    }
}
