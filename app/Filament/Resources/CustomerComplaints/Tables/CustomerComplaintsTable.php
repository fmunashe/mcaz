<?php

namespace App\Filament\Resources\CustomerComplaints\Tables;

use App\Filament\Exports\CustomerComplaintExporter;
use App\Filament\Resources\Clients\ClientResource;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ExportAction;
use Filament\Actions\ExportBulkAction;
use Filament\Actions\Exports\Enums\ExportFormat;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class CustomerComplaintsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('client.full_name')
                    ->searchable()
                    ->toggleable()
                    ->url(fn($record) => ClientResource::getUrl('view', ['record' => $record->id]))
                    ->openUrlInNewTab(false),
                TextColumn::make('complaint_number')
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('name')
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('address')
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('telephone')
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('email')
                    ->label('Email address')
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('name_of_organisation')
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('complaint_channel')
                    ->badge()
                    ->toggleable(),
                TextColumn::make('location')
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('directions_to_premises')
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('person_to_be_investigated_contact')
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('received_by')
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('signature')
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('date_received')
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('status')
                    ->searchable()
                    ->toggleable(),
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
            ->headerActions([
                ExportAction::make()
                    ->exporter(CustomerComplaintExporter::class)
                    ->columnMappingColumns(3)
                    ->formats([
                        ExportFormat::Xlsx,
                        ExportFormat::Csv,
                    ]),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    ExportBulkAction::make()
                        ->exporter(CustomerComplaintExporter::class)
                        ->columnMappingColumns(3)
                        ->formats([
                            ExportFormat::Xlsx,
                            ExportFormat::Csv,
                        ]),
                ]),
            ]);
    }
}
