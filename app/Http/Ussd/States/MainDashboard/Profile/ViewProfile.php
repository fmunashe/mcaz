<?php

namespace App\Http\Ussd\States\MainDashboard\Profile;

use App\Models\Client;
use Sparors\Ussd\State;

class ViewProfile extends State
{
    protected function beforeRendering(): void
    {
        $user = Client::query()->where('phone', $this->record->get('phoneNumber'))->first();
        $terms = $user->accepted_terms ? 'Yes' : 'No';
        $profileString = 'Name: ' . $user->full_name . '\n' .
            'Phone: ' . $user->phone . '\n' .
            'Email: ' . $user->email . '\n' .
            'Username: ' . $user->username . '\n' .
            'Language: ' . $user->language->name . '\n' .
            'Role: ' . $user->role->name . '\n' .
            'Accepted Terms: ' . $terms;
        $this->menu->line('Profile Details');
        $this->menu->line($profileString);
        $this->menu->paginateListing([
            'Back'], 1, 1, '. ');
    }

    protected function afterRendering(string $argument): void
    {
        if (empty($argument) || $argument != 1) {
            $this->decision->any(self::class);
            return;
        }
        $this->decision->equal('1', MyProfile::class);
    }
}
