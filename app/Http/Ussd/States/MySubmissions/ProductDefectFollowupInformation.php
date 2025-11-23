<?php

namespace App\Http\Ussd\States\MySubmissions;

use App\Models\ProductDefect;
use Sparors\Ussd\State;

class ProductDefectFollowupInformation extends State
{
    protected function beforeRendering(): void
    {

        $this->menu->line('Enter the followup information for the product defect with reference ' . $this->record->get('productDefectReference'));

    }

    protected function afterRendering(string $argument): void
    {
        if (empty($argument)) {
            $this->decision->any(self::class);
            return;
        }
        $this->record->set('productDefectFollowupInformation', $argument);

        $defect = ProductDefect::query()->where('report_number', $this->record->get('productDefectReference'))->first();

        if ($defect) {
            \App\Models\ProductDefectsFollowupInformation::create([
                'product_defect_id' => $defect->id,
                'followup_information' => $this->record->get('productDefectFollowupInformation')
            ]);
            $this->decision->any(ProductDefectFollowupInformationSuccessful::class);
        } else {
            $this->decision->any(ProductDefectFollowupInformationFail::class);
        }

        $this->decision->any(ProductDefectFollowupInformationSuccessful::class);
    }
}
