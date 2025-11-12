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
            ->paginateListing($roles, 1, 6, '. ');
    }

    protected function afterRendering(string $argument): void
    {
        $roleOption = $argument;

        if (in_array($roleOption, ['1', '2', '3', '4', '5'])) {
            $this->record->set('roleId', $argument);
            switch ($argument) {
                case '1':
                    $this->record->set('roleName', 'Patient');
                    break;
                case '2':
                    $this->record->set('roleName', 'Sponsor');
                    break;
                case '3':
                    $this->record->set('roleName', 'Healthcare Worker');
                    break;
                case '4':
                    $this->record->set('roleName', 'Investigator');
                    break;
                case '5':
                    $this->record->set('roleName', 'Other');
                    break;
            }
            $role = Role::query()->where('name', $this->record->get('roleName'))->first();
            if ($role) {
                $this->record->set('roleId', $role->id);
                $this->record->set('roleName', $role->name);
            }
        }
        $this->decision->in(['1', '2', '3', '4', '5'], EnterFullName::class);
        $this->decision->equal('6', ExitState::class);
        $this->decision->any(InvalidMenuSelection::class);
    }
}
