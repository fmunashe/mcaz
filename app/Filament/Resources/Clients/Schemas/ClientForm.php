<?php

namespace App\Filament\Resources\Clients\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class ClientForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('full_name')
                    ->required(),
                TextInput::make('email')
                    ->label('Email address')
                    ->email()
                    ->required(),
                TextInput::make('phone')
                    ->tel()
                    ->required(),
                TextInput::make('username')
                    ->required(),
                Select::make('language_id')
                    ->relationship('language', 'name')
                    ->required(),
                Select::make('role_id')
                    ->relationship('role', 'name')
                    ->required(),
                Toggle::make('accepted_terms')
                    ->required(),
                Select::make('notify_via')
                    ->options(['sms' => 'Sms', 'email' => 'Email'])
                    ->default('email')
                    ->required(),
                Textarea::make('institution')
                    ->columnSpanFull(),
            ]);
    }
}
