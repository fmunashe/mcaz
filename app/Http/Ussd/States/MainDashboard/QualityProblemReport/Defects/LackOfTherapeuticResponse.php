<?php

namespace App\Http\Ussd\States\MainDashboard\QualityProblemReport\Defects;

use Sparors\Ussd\State;

class LackOfTherapeuticResponse extends State
{
    protected function beforeRendering(): void
    {
        $this->menu->line('Lack of therapeutic response')
            ->paginateListing([
                'Yes',
                'No'
            ], 1, 3, '. ');
    }

    protected function afterRendering(string $argument): void
    {
        if ($argument == '1') {
            $this->record->set('lackOfTherapeuticResponse', 'Yes');
            $this->decision->any(LackOfTherapeuticResponseComment::class);
        } elseif ($argument == '2') {
            $this->record->set('lackOfTherapeuticResponse', 'No');
            $this->record->set('lackOfTherapeuticResponseComment', null);
            $this->decision->any(Other::class);
        } else {
            $this->decision->any(LackOfTherapeuticResponse::class);
        }
    }
}
