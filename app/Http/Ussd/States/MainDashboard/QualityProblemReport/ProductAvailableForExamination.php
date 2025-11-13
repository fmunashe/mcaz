<?php

namespace App\Http\Ussd\States\MainDashboard\QualityProblemReport;

use App\Models\ProductDefect;
use Sparors\Ussd\State;

class ProductAvailableForExamination extends State
{
    protected function beforeRendering(): void
    {
        $this->menu->line('Product available for examination')
            ->paginateListing([
                'Yes',
                'No'
            ], 1, 3, '. ');
    }

    protected function afterRendering(string $argument): void
    {
        if ($argument == '1') {
            $this->record->set('productAvailableForExamination', 'Yes');
            $this->decision->any(ReporterSignature::class);
        } elseif ($argument == '2') {
            $this->record->set('productAvailableForExamination', 'No');
            $this->decision->any(ReporterSignature::class);
        } else {
            $this->decision->any(ProductAvailableForExamination::class);
        }
    }
}
