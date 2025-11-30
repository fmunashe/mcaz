<?php

namespace App\Filament\Resources\AEFIS\RelationManagers;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class VaccinesRelationManager extends RelationManager
{
    protected static string $relationship = 'vaccines';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->columns(3)
            ->components([
                TextInput::make('vaccine_name')
                ->required(),
                TextInput::make('brand_name')
                ->required(),
                TextInput::make('manufacturer')
                ->required(),
                DatePicker::make('date_of_vaccination')
                ->required(),
                DateTimePicker::make('time_of_vaccination')
                ->required(),
                TextInput::make('dose')
                ->required(),
                TextInput::make('batch_number')
                ->required(),
                DatePicker::make('expiry_date')
                ->required(),
                TextInput::make('diluent_batch_number'),
                DatePicker::make('diluent_expiry_date'),
                TextInput::make('diluent_time_of_reconstitution'),
            ]);
    }

    public function infolist(Schema $schema): Schema
    {
        return $schema
            ->inlineLabel()
            ->components([
                TextEntry::make('vaccine_name')
                    ->placeholder('-'),
                TextEntry::make('brand_name')
                    ->placeholder('-'),
                TextEntry::make('manufacturer')
                    ->placeholder('-'),
                TextEntry::make('date_of_vaccination')
                    ->placeholder('-'),
                TextEntry::make('time_of_vaccination')
                    ->placeholder('-'),
                TextEntry::make('dose')
                    ->placeholder('-'),
                TextEntry::make('batch_number')
                    ->placeholder('-'),
                TextEntry::make('expiry_date')
                    ->placeholder('-'),
                TextEntry::make('diluent_batch_number')
                    ->placeholder('-'),
                TextEntry::make('diluent_expiry_date')
                    ->placeholder('-'),
                TextEntry::make('diluent_time_of_reconstitution')
                    ->placeholder('-'),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('a_e_f_i_id')
            ->columns([
                TextColumn::make('vaccine_name')
                    ->searchable()
                    ->toggleable()
                    ->sortable(),
                TextColumn::make('brand_name')
                    ->searchable()
                    ->toggleable()
                    ->sortable(),
                TextColumn::make('manufacturer')
                    ->searchable()
                    ->toggleable()
                    ->sortable(),
                TextColumn::make('date_of_vaccination')
                    ->searchable()
                    ->toggleable()
                    ->sortable(),
                TextColumn::make('time_of_vaccination')
                    ->searchable()
                    ->toggleable()
                    ->sortable(),
                TextColumn::make('dose')
                    ->searchable()
                    ->toggleable()
                    ->sortable(),
                TextColumn::make('batch_number')
                    ->searchable()
                    ->toggleable()
                    ->sortable(),
                TextColumn::make('expiry_date')
                    ->searchable()
                    ->toggleable()
                    ->sortable(),
                TextColumn::make('diluent_batch_number')
                    ->searchable()
                    ->toggleable()
                    ->sortable(),
                TextColumn::make('diluent_expiry_date')
                    ->searchable()
                    ->toggleable()
                    ->sortable(),
                TextColumn::make('diluent_time_of_reconstitution')
                    ->searchable()
                    ->toggleable()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                CreateAction::make(),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
