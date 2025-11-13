<?php

namespace App\Http\Ussd\States\MainDashboard\QualityProblemReport\Defects;

use Sparors\Ussd\State;

class WrongStrength extends State
{
    protected function beforeRendering(): void
    {
        $this->menu->line('Wrong strength')
            ->paginateListing([
                'Yes',
                'No'
            ], 1, 3, '. ');
    }

    protected function afterRendering(string $argument): void
    {
        if ($argument == '1') {
            $this->record->set('wrongStrength', 'Yes');
            $this->decision->any(WrongStrengthComment::class);
        } elseif ($argument == '2') {
            $this->record->set('wrongStrength', 'No');
            $this->record->set('wrongStrengthComment', null);
            $this->decision->any(LackOfTherapeuticResponse::class);
        } else {
            $this->decision->any(WrongStrength::class);
        }
    }
}
