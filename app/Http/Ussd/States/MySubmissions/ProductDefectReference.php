<?php

namespace App\Http\Ussd\States\MySubmissions;

use Sparors\Ussd\State;

class ProductDefectReference extends State
{
    protected function beforeRendering(): void
    {
        $this->menu->line('Enter the reference number of product defect you want to add followup information');
    }

    protected function afterRendering(string $argument): void
    {
        if (empty($argument)) {
            $this->decision->any(self::class);
            return;
        }
        $this->record->set('productDefectReference', $argument);
        $this->decision->any(ProductDefectFollowupInformation::class);
    }
}
