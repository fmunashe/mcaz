<?php

namespace App\Http\Ussd\States\MainDashboard\Profile;

use App\Http\Ussd\Actions\MainDashboard\Profile\ConfirmCurrentPin;
use Illuminate\Support\Facades\Hash;
use Sparors\Ussd\State;

class ChangePinOrPassword extends State
{
    protected function beforeRendering(): void
    {
        $this->menu->text('Enter current pin');
        $this->menu->lineBreak();
        $this->menu->paginateListing([
            'Back'], 1, 2, '. ');
    }

    protected function afterRendering(string $argument): void
    {
        $currentPin = $argument;
        $this->record->set('currentPin', $currentPin);
        $this->decision->equal('1', MyProfile::class);
        $this->decision->any(ConfirmCurrentPin::class);
    }
}
