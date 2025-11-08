<?php

namespace App\Http\Ussd\States\Registration;

use App\Http\Ussd\States\ExitState;
use App\Http\Ussd\States\InvalidMenuSelection;
use App\Models\Role;
use Sparors\Ussd\State;

class Register extends State
{
    protected function beforeRendering(): void
    {
        $roles = Role::query()->pluck('name')->toArray();
        $roles[] = 'Exit';
        $this->menu->text('Select Role')
            ->lineBreak(2)
            ->paginateListing($roles, 1, 6, '. ');
    }

    protected function afterRendering(string $argument): void
    {
        $roleOption = $argument;

        if (in_array($roleOption, ['1', '2', '3','4','5'])) {
            $role = Role::query()->where('id', $roleOption)->first();
            if ($role) {
                $this->record->set('roleId', $role->id);
                $this->record->set('roleName', $role->name);
            }
        }
        $this->decision->in(['1', '2', '3'], EnterFullName::class);
        $this->decision->equal('4', ExitState::class);
        $this->decision->any( InvalidMenuSelection::class);
    }
}
