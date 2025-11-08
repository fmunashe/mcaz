<?php

namespace App\Http\Ussd\States\Help;

use Sparors\Ussd\State;

class CustomerService extends State
{
    protected function beforeRendering(): void
    {
        $this->menu->paginateListing([
            'Customer service : customerservice@mcaz.co.zw',
            'Back'], 1, 5, '. ');
    }

    protected function afterRendering(string $argument): void
    {
        $this->decision->any(ContactMcazSupport::class);
    }
}
