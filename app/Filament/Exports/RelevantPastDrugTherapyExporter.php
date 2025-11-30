<?php

namespace App\Filament\Exports;

use App\Models\RelevantPastDrugTherapy;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;
use Illuminate\Support\Number;

class RelevantPastDrugTherapyExporter extends Exporter
{
    protected static ?string $model = RelevantPastDrugTherapy::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('brand_name'),
            ExportColumn::make('batch_number'),
            ExportColumn::make('dose'),
            ExportColumn::make('frequency'),
            ExportColumn::make('date_started'),
            ExportColumn::make('date_stopped'),
            ExportColumn::make('suspected_medicine'),
            ExportColumn::make('created_at'),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your relevant past drug therapy export has completed and ' . Number::format($export->successful_rows) . ' ' . str('row')->plural($export->successful_rows) . ' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . Number::format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to export.';
        }

        return $body;
    }
}
