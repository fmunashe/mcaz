<?php

namespace App\Http\Ussd\States\MainDashboard\AEFI;

use App\Http\Ussd\Actions\MainDashboard\AEFI\CheckGender;
use App\OTPGeneration;
use Sparors\Ussd\State;

class Gender extends State
{
    use OTPGeneration;

    protected function beforeRendering(): void
    {
        $this->menu->line('Gender');
        $this->menu->paginateListing([
            'Male',
            'Female'
        ], 1, 4, '. ');
    }

    protected function afterRendering(string $argument): void
    {
        if ($argument == '1') {
            $gender = $this->getGenderByName('male');
            $this->record->set('genderId', $gender->id);
            $this->record->set('gender', $gender->gender);
            $this->decision->any(CheckGender::class);
        } else {
            $gender = $this->getGenderByName('female');
            $this->record->set('genderId', $gender->id);
            $this->record->set('gender', $gender->gender);
            $this->decision->any(CheckGender::class);
        }
        $this->decision->any(Gender::class);
    }
}
