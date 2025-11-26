<?php

namespace App\Http\Ussd\States\Help;

use Sparors\Ussd\State;

class TalkToAgent extends State
{
    protected function beforeRendering(): void
    {
        $link = env('WHATSAPP_AGENT_NUMBER');
        $this->menu->line('Click on this link to speak to an agent');
        $this->menu->line($link);
        $this->menu->paginateListing([
            'Back',
        ], 1, 1, '. ');
    }

    protected function afterRendering(string $argument): void
    {
        $this->decision->any(ContactMcazSupport::class);
    }
}
