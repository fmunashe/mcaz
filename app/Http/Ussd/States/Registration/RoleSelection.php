<?php

namespace App\Http\Ussd\States\Registration;

use App\Http\Ussd\States\ExitState;
use Sparors\Ussd\State;

class RoleSelection extends State
{
    protected function beforeRendering(): void
    {
        $this->menu->text('Select Role')
            ->lineBreak()
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
        // Handle role selection
        if (in_array($argument, ['1', '2', '3'])) {
            $this->record->set('roleId', $argument);
            switch ($argument) {
                case '1':
                    $this->record->set('roleName', 'Healthcare Worker');
                    break;
                case '2':
                    $this->record->set('roleName', 'Patient');
                    break;
                case '3':
                    $this->record->set('roleName', 'Other');
                    break;
            }
            $this->decision->any(EnterFullName::class);
        } else if ($argument === '4') {
            $this->decision->any(ExitState::class);
        } else {
            // Invalid selection, show the menu again
            $this->menu->text('Invalid selection. Please choose a valid option');
            $this->decision->any(RoleSelection::class);
        }
    }
}
