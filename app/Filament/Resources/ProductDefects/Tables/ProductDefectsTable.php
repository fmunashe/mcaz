<?php

namespace App\Filament\Resources\ProductDefects\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ProductDefectsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('client.full_name')
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('product_name')
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('registration_number')
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('batch_number')
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('expiry_date')
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('name_of_reporter')
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('title_of_reporter')
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('practice_location')
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('practise_address')
                    ->label('Practice Address')
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('phone_number')
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('date_problem_observed')
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('product_available_for_examination')
                    ->badge()
                    ->toggleable(),
                TextColumn::make('reporter_signature')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('report_number')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
