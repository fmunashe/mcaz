<?php

namespace App\Http\Ussd\States\MainDashboard\Profile;

use App\Http\Ussd\States\InvalidMenuSelection;
use Illuminate\Support\Facades\Hash;
use Sparors\Ussd\State;

class ChangePinNewScreen extends State
{
    protected function beforeRendering(): void
    {
        $this->menu->text('Enter new pin');
        $this->menu->lineBreak();
        $this->menu->paginateListing([
            'Back'], 1, 2, '. ');
    }

    protected function afterRendering(string $argument): void
    {
        $newPin = $argument;
        $this->record->set('newPin', Hash::make($newPin));
        $this->decision->equal('1', ChangePinOrPassword::class);
        $this->decision->any(NewPinSetSuccessfully::class);
    }
}
