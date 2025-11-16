<?php

namespace App\Http\Ussd\Actions\MainDashboard\AEFI;

use App\Http\Ussd\States\MainDashboard\AEFI\DateOfBirth;
use App\Http\Ussd\States\MainDashboard\AEFI\PregnancyStatus;
use Sparors\Ussd\Action;

class CheckGender extends Action
{
    public function run(): string
    {
        if ($this->record->get('gender') == 'female') {
            return PregnancyStatus::class;
        }
        return DateOfBirth::class;
    }
}
