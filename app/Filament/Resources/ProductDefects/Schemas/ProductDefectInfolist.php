<?php

namespace App\Filament\Resources\ProductDefects\Schemas;

use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Components\RepeatableEntry\TableColumn;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class ProductDefectInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('client.id')
                    ->label('Client')
                    ->placeholder('-'),
                TextEntry::make('product_name')
                    ->placeholder('-'),
                TextEntry::make('description')
                    ->placeholder('-'),
                TextEntry::make('intended_use')
                    ->placeholder('-'),
                TextEntry::make('type_of_container')
                    ->placeholder('-'),
                TextEntry::make('registration_number')
                    ->placeholder('-'),
                TextEntry::make('batch_number')
                    ->placeholder('-'),
                TextEntry::make('expiry_date')
                    ->placeholder('-'),
                TextEntry::make('name_of_manufacturer')
                    ->placeholder('-'),
                TextEntry::make('address_of_manufacturer')
                    ->placeholder('-'),
                TextEntry::make('name_of_reporter')
                    ->placeholder('-'),
                TextEntry::make('title_of_reporter')
                    ->placeholder('-'),
                TextEntry::make('practice_location')
                    ->placeholder('-'),
                TextEntry::make('practise_address')
                    ->placeholder('-'),
                TextEntry::make('phone_number')
                    ->placeholder('-'),
                TextEntry::make('date_problem_observed')
                    ->placeholder('-'),
                TextEntry::make('product_available_for_examination')
                    ->badge()
                    ->placeholder('-'),
                TextEntry::make('reporter_signature')
                    ->placeholder('-'),
                TextEntry::make('report_number')
                    ->placeholder('-'),
                RepeatableEntry::make('tets')
                    ->table([
                        TableColumn::make('Author'),
                        TableColumn::make('Title'),
                        TableColumn::make('Published'),
                    ])
            ]);
    }
}
