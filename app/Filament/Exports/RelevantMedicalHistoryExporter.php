<?php

namespace App\Filament\Exports;

use App\Models\RelevantMedicalHistory;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;
use Illuminate\Support\Number;

class RelevantMedicalHistoryExporter extends Exporter
{
    protected static ?string $model = RelevantMedicalHistory::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('relevant_medical_history'),
            ExportColumn::make('lab_test_results'),
            ExportColumn::make('actionTaken.action_taken'),
            ExportColumn::make('a_d_r_outcome.outcome'),
            ExportColumn::make('created_at'),
            ExportColumn::make('updated_at'),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your relevant medical history export has completed and ' . Number::format($export->successful_rows) . ' ' . str('row')->plural($export->successful_rows) . ' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . Number::format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to export.';
        }

        return $body;
    }
}
