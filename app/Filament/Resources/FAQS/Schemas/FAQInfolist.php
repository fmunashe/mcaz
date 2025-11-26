<?php

namespace App\Filament\Resources\FAQS\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class FAQInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('question'),
                TextEntry::make('answer')
                    ->columnSpanFull()
            ]);
    }
}
