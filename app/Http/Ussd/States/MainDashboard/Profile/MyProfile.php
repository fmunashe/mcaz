<?php

namespace App\Http\Ussd\States\MainDashboard\Profile;

use App\Http\Ussd\States\InvalidMenuSelection;
use App\Http\Ussd\States\MainDashboard\Dashboard;
use Sparors\Ussd\State;

class MyProfile extends State
{
    protected function beforeRendering(): void
    {
        $this->menu->paginateListing([
            'View Profile',
            'Edit Contact (Phone/Email → OTP verify)',
            'Change PIN / Password',
            'Language Preference',
            'Profession / Role',
            'Link Facility / Institution',
            'Notification Preferences (SMS / Email)',
            'Privacy & Deactivation',
            'Back'], 1, 10, '. ');
    }

    protected function afterRendering(string $argument): void
    {
        $this->decision->equal('1', ViewProfile::class);
        $this->decision->equal('2', UpdateContact::class);
        $this->decision->equal('3', ChangePinOrPassword::class);
        $this->decision->equal('4', LanguagePreference::class);
        $this->decision->equal('5', ProfessionOrRole::class);
        $this->decision->equal('6', LinkFacilityOrInstitution::class);
        $this->decision->equal('7', NotificationPreference::class);
        $this->decision->equal('8', PrivacyAndDeactivation::class);
        $this->decision->equal('9', Dashboard::class);
        $this->decision->any(InvalidMenuSelection::class);
    }
}
