<?php

namespace App\Filament\Resources\ADRS\RelationManagers;

use App\Filament\Exports\AdverseReactionExporter;
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
use Filament\Forms\Components\Toggle;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class AdverseReactionsRelationManager extends RelationManager
{
    protected static string $relationship = 'adverseReactions';

    protected static ?string $title = 'Adverse Reactions';

    protected static ?string $modelLabel = 'Adverse Reaction';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('description')
                    ->required(),
                DatePicker::make('onset_date')
                    ->required(),
                Select::make('duration_id')
                    ->relationship('durations', 'duration')
                    ->searchable()
                    ->preload()
                    ->required(),
                TextInput::make('duration')
                    ->label('Duration Period e.g 10')
                    ->numeric()
                    ->required(),
                Toggle::make('serious'),
                Select::make('a_d_r_serious_reason_id')
                    ->relationship('aDRSeriousReason', 'reason')
                    ->searchable()
                    ->preload(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('description')
            ->columns([
                TextColumn::make('description')
                    ->toggleable()
                    ->sortable(),
                TextColumn::make('onset_date')
                    ->toggleable()
                    ->sortable(),
                TextColumn::make('duration')
                    ->toggleable()
                    ->sortable(),
                TextColumn::make('durations.duration')
                    ->label('Medication Duration')
                    ->toggleable()
                    ->sortable(),
                TextColumn::make('serious')
                    ->toggleable()
                    ->sortable(),
                TextColumn::make('aDRSeriousReason.reason')
                    ->label('Reason')
                    ->toggleable()
                    ->sortable(),
            ])
            ->filters([
//
            ])
            ->headerActions([
                CreateAction::make(),
                ExportAction::make()
                    ->exporter(AdverseReactionExporter::class)
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
                        ->exporter(AdverseReactionExporter::class)
                        ->columnMappingColumns(3)
                        ->formats([
                            ExportFormat::Xlsx,
                            ExportFormat::Csv,
                        ]),
                ]),
            ]);
    }
}
