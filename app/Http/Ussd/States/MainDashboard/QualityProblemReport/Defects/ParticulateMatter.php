<?php

namespace App\Http\Ussd\States\MainDashboard\QualityProblemReport\Defects;

use Sparors\Ussd\State;

class ParticulateMatter extends State
{
    protected function beforeRendering(): void
    {
        $this->menu->line('Particulate matter')
            ->paginateListing([
                'Yes',
                'No'
            ], 1, 3, '. ');
    }

    protected function afterRendering(string $argument): void
    {
        if ($argument == '1') {
            $this->record->set('particulateMatter', 'Yes');
            $this->decision->any(ParticulateMatterComment::class);
        } elseif ($argument == '2') {
            $this->record->set('particulateMatter', 'No');
            $this->record->set('particulateMatterComment', null);
            $this->decision->any(Discoloration::class);
        } else {
            $this->decision->any(ParticulateMatter::class);
        }
    }
}
