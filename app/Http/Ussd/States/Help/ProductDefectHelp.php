<?php

namespace App\Http\Ussd\States\Help;

use Sparors\Ussd\State;

class ProductDefectHelp extends State
{
    protected function beforeRendering(): void
    {
        $this->menu->line('A medicine, vaccine or medical device product that is not of the correct quality, safety or efficacy as defined by its Marketing Authorisation which may pose risk to the users.');
        $this->menu->paginateListing([
            'Back',
        ], 1, 1, '. ');
    }

    protected function afterRendering(string $argument): void
    {
        if (empty($argument) || $argument != 1) {
            $this->decision->any(self::class);
            return;
        }
        $this->decision->equal('1', WhatIsAdrAefiProductDefect::class);
        $this->decision->any(ProductDefectHelp::class);
    }
}
