<?php

namespace App\Http\Ussd\States\MainDashboard\Profile;

use App\Http\Ussd\States\InvalidMenuSelection;
use Sparors\Ussd\State;

class ContactUpdateSuccessful extends State
{
    protected function beforeRendering(): void
    {
        $this->menu->text('Contact updated successfully');
        $this->menu->lineBreak();
        $this->menu->paginateListing([
            'Back'], 1, 2, '. ');
    }

    protected function afterRendering(string $argument): void
    {
        $this->decision->equal('1', MyProfile::class);
        $this->decision->any(InvalidMenuSelection::class);
    }
}
