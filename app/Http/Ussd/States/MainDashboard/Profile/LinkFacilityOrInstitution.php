<?php

namespace App\Http\Ussd\States\MainDashboard\Profile;

use Sparors\Ussd\State;

class LinkFacilityOrInstitution extends State
{
    protected function beforeRendering(): void
    {
        $this->menu->text('Enter Facility or Institution');
        $this->menu->lineBreak();
        $this->menu->paginateListing([
            'Back'], 1, 2, '. ');
    }

    protected function afterRendering(string $argument): void
    {
        $facilityOrInstitution = $argument;
        $this->record->set('facilityOrInstitution', $facilityOrInstitution);
        $this->decision->equal('1',MyProfile::class);
        $this->decision->any(FacilitySetSuccessfully::class);
    }
}
