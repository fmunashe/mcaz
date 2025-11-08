<?php

namespace App\Http\Ussd\States\MainDashboard\Profile;

use App\Http\Ussd\States\InvalidMenuSelection;
use App\UssdLoggedInUser;
use Sparors\Ussd\State;

class FacilitySetSuccessfully extends State
{
    use UssdLoggedInUser;

    protected function beforeRendering(): void
    {
        $client = $this->getUserByPhone($this->record->get('phoneNumber'));
        $client->update([
            'institution' => $this->record->get('facilityOrInstitution')
        ]);
        $this->menu->text('Facility set successfully');
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
