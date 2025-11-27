<?php

namespace App\Http\Ussd\States\MainDashboard\ADR;

use App\Http\Ussd\States\MainDashboard\ADR\Reactions\DateOfOnset;
use Illuminate\Support\Str;
use Sparors\Ussd\State;

class Gender extends State
{
    protected function beforeRendering(): void
    {
        $this->menu->line('Sex');
        $this->menu->paginateListing([
            'Male',
            'Female'
        ], 1, 2, '. ');
    }

    protected function afterRendering(string $argument): void
    {
        if (empty($argument) || !in_array($argument, [1, 2])) {
            $this->decision->any(self::class);
            return;
        }
        if ($argument == 1) {
            $gender = $this->getGenderByName(Str::lower('Male'));
        } else {
            $gender = $this->getGenderByName(Str::lower('Female'));
        }
        $this->record->set('genderId', $gender->id);
        $this->decision->any(DateOfOnset::class);
    }

    private function getGenderByName($gender)
    {
        return \App\Models\Gender::where('gender', $gender)->first();
    }
}
