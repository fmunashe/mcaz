<?php

namespace App\Filament\Exports;

use App\Models\ADR;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;
use Illuminate\Support\Number;

class ADRExporter extends Exporter
{
    protected static ?string $model = ADR::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('client.full_name'),
            ExportColumn::make('mcaz_reference_number'),
            ExportColumn::make('hospital_name'),
            ExportColumn::make('hospital_number'),
            ExportColumn::make('patient_initials'),
            ExportColumn::make('vct_or_tb_number'),
            ExportColumn::make('dob'),
            ExportColumn::make('weight'),
            ExportColumn::make('height'),
            ExportColumn::make('age'),
            ExportColumn::make('gender.id'),
            ExportColumn::make('reported_by'),
            ExportColumn::make('designation'),
            ExportColumn::make('email_address'),
            ExportColumn::make('phone_number'),
            ExportColumn::make('institution_name'),
            ExportColumn::make('institution_address'),
            ExportColumn::make('status'),
            ExportColumn::make('created_at'),
            ExportColumn::make('updated_at'),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your a d r export has completed and ' . Number::format($export->successful_rows) . ' ' . str('row')->plural($export->successful_rows) . ' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . Number::format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to export.';
        }

        return $body;
    }
}
