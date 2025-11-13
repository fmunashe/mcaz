<?php

namespace App\Http\Ussd\States\MainDashboard\QualityProblemReport\Defects;

use Sparors\Ussd\State;

class Discoloration extends State
{
    protected function beforeRendering(): void
    {
        $this->menu->line('Discoloration')
            ->paginateListing([
                'Yes',
                'No'
            ], 1, 3, '. ');
    }

    protected function afterRendering(string $argument): void
    {
        if ($argument == '1') {
            $this->record->set('discoloration', 'Yes');
            $this->decision->any(DiscolorationComment::class);
        } elseif ($argument == '2') {
            $this->record->set('discoloration', 'No');
            $this->record->set('discolorationComment', null);
            $this->decision->any(WrongLabel::class);
        } else {
            $this->decision->any(Discoloration::class);
        }
    }
}
