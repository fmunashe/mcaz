<?php

namespace App\Http\Ussd\States\MainDashboard\AEFI;

use Sparors\Ussd\State;

class AgeGroup extends State
{
    protected function beforeRendering(): void
    {
        $this->menu->line('Age group');
        $this->menu->paginateListing([
            'Less than 1 year',
            '1-5 years',
            '6-18 years',
            '19-60 years',
            '61 years and above'
        ], 1, 5, '. ');
    }

    protected function afterRendering(string $argument): void
    {
        if (in_array($argument, ['1', '2', '3', '4', '5'])) {
            $this->setAgeGroup($argument);
            $this->decision->any(ReporterName::class);
        }
        $this->decision->any(AgeGroup::class);
    }


    private function setAgeGroup($option): void
    {
        if ($option == '1') {
            $ageGroup = \App\Models\AgeGroup::query()->where('age_group', 'Less than 1 year')->first();
            $this->record->set('ageGroupId', $ageGroup->id);
        } elseif ($option == '2') {
            $ageGroup = \App\Models\AgeGroup::query()->where('age_group', '1-5 years')->first();
            $this->record->set('ageGroupId', $ageGroup->id);
        } elseif ($option == '3') {
            $ageGroup = \App\Models\AgeGroup::query()->where('age_group', '6-18 years')->first();
            $this->record->set('ageGroupId', $ageGroup->id);
        } elseif ($option == '4') {
            $ageGroup = \App\Models\AgeGroup::query()->where('age_group', '19-60 years')->first();
            $this->record->set('ageGroupId', $ageGroup->id);
        } elseif ($option == '5') {
            $ageGroup = \App\Models\AgeGroup::query()->where('age_group', '61 years and above')->first();
            $this->record->set('ageGroupId', $ageGroup->id);
        }
    }
}
