<?php

namespace App\Http\Ussd\States\MainDashboard\AEFI\Vaccines;

use Sparors\Ussd\State;

class BrandName extends State
{
    protected function beforeRendering(): void
    {
        $this->menu->line('Brand name');
    }

    protected function afterRendering(string $argument): void
    {
        $count = $this->record->get('vaccineCount');
        $this->record->set('brandName'.$count, $argument);
        $this->decision->any(Manufacturer::class);
    }
}
