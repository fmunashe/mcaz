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
        $this->menu->text('Select Role')
            ->lineBreak(2)
            ->paginateListing([
                'Healthcare Worker',
                'Patient',
                'Other',
                'Exit'], 1, 5, '. ')
            ->lineBreak(2)
            ->line('9. Next Page')
            ->line('#. Back')
            ->line('Main Menu');
    }

    protected function afterRendering(string $argument): void
    {
        $roleOption = $argument;

        if (in_array($roleOption, ['1', '2', '3'])) {
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
