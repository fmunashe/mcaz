<?php

namespace App\Http\Ussd\States\MainDashboard\QualityProblemReport;

use Sparors\Ussd\State;

class ReportQualityProblem extends State
{
    protected function beforeRendering(): void
    {
        $this->menu->line('Product Name (Brand and Generic)');
    }

    protected function afterRendering(string $argument): void
    {
        $this->record->set('productName', $argument);
        $this->decision->any(DescriptionOfDevice::class);
    }
}
