<?php

namespace App\Http\Ussd\States\MainDashboard\Profile;

use App\Http\Ussd\States\InvalidMenuSelection;
use App\Http\Ussd\States\MainDashboard\Dashboard;
use App\Models\Client;
use Sparors\Ussd\State;

class ViewProfile extends State
{
    protected function beforeRendering(): void
    {
        $user = Client::query()->where('phone',$this->record->get('phoneNumber'))->first();
        $terms = $user->accepted_terms?'Yes':'No';
        $this->menu->paginateListing([
            'Name: '.$user->full_name,
            'Phone: '.$user->phone,
            'Email: '.$user->email,
            'Username: '.$user->username,
            'Language: '.$user->language->name,
            'Role: '.$user->role->name,
            'Accepted Terms: '.$terms,
            'Back'], 1, 10, '. ');
    }

    protected function afterRendering(string $argument): void
    {
        $this->decision->in(['1','2','3','4','5','6','7'], ViewProfile::class);
        $this->decision->equal('8', MyProfile::class);
        $this->decision->any(MyProfile::class);
    }
}
