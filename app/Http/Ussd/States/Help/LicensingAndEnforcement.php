<?php

namespace App\Http\Ussd\States\Help;

use Sparors\Ussd\State;

class LicensingAndEnforcement extends State
{
    protected function beforeRendering(): void
    {
        $this->menu->paginateListing([
            'GMP Inspections : gmp@mcaz.co.zw',
            'Imports and Exports : imports@mcaz.co.zw',
            'Licensing Related : licensingunit@mcaz.co.zw',
            'Back'], 1, 5, '. ');
    }

    protected function afterRendering(string $argument): void
    {
        $this->decision->any(ContactMcazSupport::class);
    }
}
