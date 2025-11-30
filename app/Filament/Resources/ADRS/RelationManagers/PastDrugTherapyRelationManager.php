<?php

namespace App\Filament\Resources\ADRS\RelationManagers;

use App\Filament\Exports\RelevantPastDrugTherapyExporter;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ExportAction;
use Filament\Actions\ExportBulkAction;
use Filament\Actions\Exports\Enums\ExportFormat;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class PastDrugTherapyRelationManager extends RelationManager
{
    protected static string $relationship = 'pastDrugTherapy';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('brand_name')
                    ->required(),
                TextInput::make('batch_number')
                    ->required(),
                TextInput::make('dose')
                    ->required(),
                TextInput::make('frequency')
                    ->required(),
                DatePicker::make('date_started')
                    ->required(),
                DatePicker::make('date_stopped')
                    ->required(),
                Select::make('suspected_medicine')
                    ->options(['Yes' => 'Yes', 'No' => 'No'])
                    ->searchable()
                    ->preload()
                    ->required()
                    ->default('No'),
            ]);
    }

    public function infolist(Schema $schema): Schema
    {
        return $schema
            ->inlineLabel()
            ->components([
                TextEntry::make('brand_name')
                    ->placeholder('-'),
                TextEntry::make('batch_number')
                    ->placeholder('-'),
                TextEntry::make('dose')
                    ->placeholder('-'),
                TextEntry::make('frequency')
                    ->placeholder('-'),
                TextEntry::make('date_started')
                    ->placeholder('-'),
                TextEntry::make('date_stopped')
                    ->placeholder('-'),
                TextEntry::make('suspected_medicine')
                    ->badge()
                    ->placeholder('-'),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('a_d_r_id')
            ->columns([
                TextColumn::make('brand_name')
                    ->searchable()
                    ->sortable()
                    ->toggleable(),
                TextColumn::make('batch_number')
                    ->searchable()
                    ->sortable()
                    ->toggleable(),
                TextColumn::make('dose')
                    ->searchable()
                    ->sortable()
                    ->toggleable(),
                TextColumn::make('frequency')
                    ->searchable()
                    ->sortable()
                    ->toggleable(),
                TextColumn::make('date_started')
                    ->searchable()
                    ->sortable()
                    ->toggleable(),
                TextColumn::make('date_stopped')
                    ->searchable()
                    ->sortable()
                    ->toggleable(),
                TextColumn::make('suspected_medicine')
                    ->badge()
                    ->sortable()
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
            ->headerActions([
                CreateAction::make(),
                ExportAction::make()
                    ->exporter(RelevantPastDrugTherapyExporter::class)
                    ->columnMappingColumns(3)
                    ->formats([
                        ExportFormat::Xlsx,
                        ExportFormat::Csv,
                    ]),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    ExportBulkAction::make()
                        ->exporter(RelevantPastDrugTherapyExporter::class)
                        ->columnMappingColumns(3)
                        ->formats([
                            ExportFormat::Xlsx,
                            ExportFormat::Csv,
                        ]),
                ]),
            ]);
    }
}
