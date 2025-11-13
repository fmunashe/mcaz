<?php

namespace App\Http\Ussd\States\MainDashboard\QualityProblemReport\Defects;

use Sparors\Ussd\State;

class WrongPackaging extends State
{
    protected function beforeRendering(): void
    {
        $this->menu->line('Wrong packaging')
            ->paginateListing([
                'Yes',
                'No'
            ], 1, 3, '. ');
    }

    protected function afterRendering(string $argument): void
    {
        if ($argument == '1') {
            $this->record->set('wrongPackaging', 'Yes');
            $this->decision->any(WrongPackagingComment::class);
        } elseif ($argument == '2') {
            $this->record->set('wrongPackaging', 'No');
            $this->record->set('wrongPackagingComment', null);
            $this->decision->any(WrongStrength::class);
        } else {
            $this->decision->any(WrongPackaging::class);
        }
    }
}
