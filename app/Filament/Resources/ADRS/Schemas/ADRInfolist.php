<?php

namespace App\Filament\Resources\ADRS\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class ADRInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('client.full_name')
                    ->label('Client')
                    ->placeholder('-'),
                TextEntry::make('mcaz_reference_number')
                    ->placeholder('-'),
                TextEntry::make('hospital_name')
                    ->placeholder('-'),
                TextEntry::make('hospital_number')
                    ->placeholder('-'),
                TextEntry::make('patient_initials')
                    ->placeholder('-'),
                TextEntry::make('vct_or_tb_number')
                    ->placeholder('-'),
                TextEntry::make('dob')
                    ->placeholder('-'),
                TextEntry::make('weight')
                    ->placeholder('-'),
                TextEntry::make('height')
                    ->placeholder('-'),
                TextEntry::make('age')
                    ->placeholder('-'),
                TextEntry::make('gender.id')
                    ->label('Gender')
                    ->placeholder('-'),
                TextEntry::make('reported_by')
                    ->placeholder('-'),
                TextEntry::make('designation')
                    ->placeholder('-'),
                TextEntry::make('email_address')
                    ->placeholder('-'),
                TextEntry::make('phone_number')
                    ->placeholder('-'),
                TextEntry::make('institution_name')
                    ->placeholder('-'),
                TextEntry::make('institution_address')
                    ->placeholder('-'),
                TextEntry::make('status')
                    ->placeholder('-')
                    ->columnSpanFull()
            ]);
    }
}
