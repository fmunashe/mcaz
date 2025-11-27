<?php

namespace App\Filament\Exports;

use App\Models\CustomerComplaint;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;
use Illuminate\Support\Number;

class CustomerComplaintExporter extends Exporter
{
    protected static ?string $model = CustomerComplaint::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('client.full_name'),
            ExportColumn::make('complaint_number'),
            ExportColumn::make('name'),
            ExportColumn::make('address'),
            ExportColumn::make('telephone'),
            ExportColumn::make('email'),
            ExportColumn::make('name_of_organisation'),
            ExportColumn::make('complaint_channel'),
            ExportColumn::make('details_of_complaint'),
            ExportColumn::make('location'),
            ExportColumn::make('description_of_premises'),
            ExportColumn::make('directions_to_premises'),
            ExportColumn::make('person_to_be_investigated_contact'),
            ExportColumn::make('received_by'),
            ExportColumn::make('signature'),
            ExportColumn::make('date_received'),
            ExportColumn::make('status'),
            ExportColumn::make('created_at'),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your customer complaint export has completed and ' . Number::format($export->successful_rows) . ' ' . str('row')->plural($export->successful_rows) . ' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . Number::format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to export.';
        }

        return $body;
    }
}
