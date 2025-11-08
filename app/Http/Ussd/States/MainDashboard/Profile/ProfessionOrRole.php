<?php

namespace App\Http\Ussd\States\MainDashboard\Profile;

use App\Http\Ussd\States\InvalidMenuSelection;
use App\Models\Role;
use App\UssdLoggedInUser;
use Sparors\Ussd\State;

class ProfessionOrRole extends State
{
    use UssdLoggedInUser;

    protected function beforeRendering(): void
    {
        $this->menu->line('Select your profession');
        $roles = Role::query()->pluck('name')->toArray();
        $roles[] = 'Back';
        $this->menu->paginateListing($roles, 1, 10, '. ');

    }

    protected function afterRendering(string $argument): void
    {
        $role = $argument;
        if (in_array($role, Role::query()->pluck('id')->toArray())) {
            $user = $this->getUserByPhone($this->record->get('phoneNumber'));
            $user->role_id = $role;
            $user->save();
            $this->decision->any(ProfessionSetSuccessfully::class);
        }
        $this->decision->equal('Back', MyProfile::class);
        $this->decision->any(InvalidMenuSelection::class);
    }
}
