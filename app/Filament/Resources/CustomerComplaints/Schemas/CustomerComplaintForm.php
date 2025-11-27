<?php

namespace App\Filament\Resources\CustomerComplaints\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class CustomerComplaintForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('client_id')
                    ->relationship('client', 'id'),
                TextInput::make('complaint_number'),
                TextInput::make('name'),
                TextInput::make('address'),
                TextInput::make('telephone')
                    ->tel(),
                TextInput::make('email')
                    ->label('Email address')
                    ->email(),
                TextInput::make('name_of_organisation'),
                Select::make('complaint_channel')
                    ->options([
                        'Written' => 'Written',
                        'Email' => 'Email',
                        'Telephone' => 'Telephone',
                        'Verbal' => 'Verbal',
                        'Whatsapp' => 'Whatsapp',
                        'Facebook' => 'Facebook',
                        'Instagram' => 'Instagram',
                        'Twitter' => 'Twitter',
                        'USSD' => 'U s s d',
                    ])
                    ->default('USSD')
                ->searchable(),
                Textarea::make('details_of_complaint')
                    ->columnSpanFull(),
                TextInput::make('location'),
                Textarea::make('description_of_premises')
                    ->columnSpanFull(),
                TextInput::make('directions_to_premises'),
                TextInput::make('person_to_be_investigated_contact'),
                TextInput::make('received_by'),
                TextInput::make('signature'),
                TextInput::make('date_received'),
                TextInput::make('status'),
            ]);
    }
}
