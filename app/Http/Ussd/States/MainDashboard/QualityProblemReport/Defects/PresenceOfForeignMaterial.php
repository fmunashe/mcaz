<?php

namespace App\Http\Ussd\States\MainDashboard\QualityProblemReport\Defects;

use Sparors\Ussd\State;

class PresenceOfForeignMaterial extends State
{
    protected function beforeRendering(): void
    {
        $this->menu->line('Presence of foreign material');
        $this->menu->paginateListing([
            'Yes',
            'No'
        ], 1, 3, '. ');
    }

    protected function afterRendering(string $argument): void
    {
        if ($argument == '1') {
            $this->record->set('presenceOfForeignMaterial', 'Yes');
            $this->decision->any(PresenceOfForeignMaterialComment::class);
        } elseif ($argument == '2') {
            $this->record->set('presenceOfForeignMaterial', 'No');
            $this->record->set('presenceOfForeignMaterialComment', null);
            $this->decision->any(UnusualOdour::class);
        } else {
            $this->decision->any(PresenceOfForeignMaterial::class);
        }
    }
}
