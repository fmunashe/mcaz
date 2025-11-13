<?php

namespace App\Http\Ussd\States\MainDashboard\QualityProblemReport\Defects;

use Sparors\Ussd\State;

class WrongLabel extends State
{
    protected function beforeRendering(): void
    {
        $this->menu->line('Wrong label')
            ->paginateListing([
                'Yes',
                'No'
            ], 1, 3, '. ');
    }

    protected function afterRendering(string $argument): void
    {
        if ($argument == '1') {
            $this->record->set('wrongLabel', 'Yes');
            $this->decision->any(WrongLabelComment::class);
        } elseif ($argument == '2') {
            $this->record->set('wrongLabel', 'No');
            $this->record->set('wrongLabelComment', null);
            $this->decision->any(WrongPackaging::class);
        } else {
            $this->decision->any(WrongLabel::class);
        }
    }
}
