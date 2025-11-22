<?php

namespace App\Filament\Resources\ADRS\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class ADRForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('client_id')
                    ->relationship('client', 'id'),
                TextInput::make('mcaz_reference_number'),
                TextInput::make('hospital_name'),
                TextInput::make('hospital_number'),
                TextInput::make('patient_initials'),
                TextInput::make('vct_or_tb_number'),
                TextInput::make('dob'),
                TextInput::make('weight'),
                TextInput::make('height'),
                TextInput::make('age'),
                Select::make('gender_id')
                    ->relationship('gender', 'id'),
                TextInput::make('reported_by'),
                TextInput::make('designation'),
                TextInput::make('email_address')
                    ->email(),
                TextInput::make('phone_number')
                    ->tel(),
                TextInput::make('institution_name'),
                TextInput::make('institution_address'),
                Textarea::make('status')
                    ->columnSpanFull(),
            ]);
    }
}
