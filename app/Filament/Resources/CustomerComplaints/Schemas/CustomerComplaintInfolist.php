<?php

namespace App\Filament\Resources\CustomerComplaints\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class CustomerComplaintInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('client.full_name')
                    ->label('Client')
                    ->placeholder('-'),
                TextEntry::make('complaint_number')
                    ->placeholder('-'),
                TextEntry::make('name')
                    ->placeholder('-'),
                TextEntry::make('address')
                    ->placeholder('-'),
                TextEntry::make('telephone')
                    ->placeholder('-'),
                TextEntry::make('email')
                    ->label('Email address')
                    ->placeholder('-'),
                TextEntry::make('name_of_organisation')
                    ->placeholder('-'),
                TextEntry::make('complaint_channel')
                    ->badge()
                    ->placeholder('-'),
                TextEntry::make('details_of_complaint')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('location')
                    ->placeholder('-'),
                TextEntry::make('description_of_premises')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('directions_to_premises')
                    ->placeholder('-'),
                TextEntry::make('person_to_be_investigated_contact')
                    ->placeholder('-'),
                TextEntry::make('received_by')
                    ->placeholder('-'),
                TextEntry::make('signature')
                    ->placeholder('-'),
                TextEntry::make('date_received')
                    ->placeholder('-'),
                TextEntry::make('status')
                    ->placeholder('-')
            ]);
    }
}
