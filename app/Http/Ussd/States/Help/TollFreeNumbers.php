<?php

namespace App\Http\Ussd\States\Help;

use Sparors\Ussd\State;

class TollFreeNumbers extends State
{
    protected function beforeRendering(): void
    {
        $this->menu->paginateListing([
            'Econet : 08080641',
            'TelOne : 08004507',
            'Whatsapp Number : +263 718 855 934',
            'Back'], 1, 5, '. ');
    }

    protected function afterRendering(string $argument): void
    {
        $this->decision->any(ContactMcazSupport::class);
    }
}
