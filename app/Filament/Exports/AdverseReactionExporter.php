<?php

namespace App\Filament\Exports;

use App\Models\AdverseReaction;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;
use Illuminate\Support\Number;

class AdverseReactionExporter extends Exporter
{
    protected static ?string $model = AdverseReaction::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('onset_date'),
            ExportColumn::make('durations.duration'),
            ExportColumn::make('duration'),
            ExportColumn::make('description'),
            ExportColumn::make('serious'),
            ExportColumn::make('aDRSeriousReason.reason'),
            ExportColumn::make('created_at'),
            ExportColumn::make('updated_at'),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your adverse reaction export has completed and ' . Number::format($export->successful_rows) . ' ' . str('row')->plural($export->successful_rows) . ' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . Number::format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to export.';
        }

        return $body;
    }
}
