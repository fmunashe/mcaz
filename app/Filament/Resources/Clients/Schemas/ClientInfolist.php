<?php

namespace App\Filament\Resources\Clients\Schemas;

use App\Models\Client;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class ClientInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('full_name'),
                TextEntry::make('email')
                    ->label('Email address'),
                TextEntry::make('phone'),
                TextEntry::make('username'),
                TextEntry::make('language.name')
                    ->label('Language'),
                TextEntry::make('role.name')
                    ->label('Role'),
                IconEntry::make('accepted_terms')
                    ->boolean(),
                TextEntry::make('notify_via')
                    ->badge(),
                TextEntry::make('institution')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('deleted_at')
                    ->dateTime()
                    ->visible(fn(Client $record): bool => $record->trashed())
            ]);
    }
}
