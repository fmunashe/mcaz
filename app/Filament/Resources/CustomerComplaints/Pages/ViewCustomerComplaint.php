<?php

namespace App\Filament\Resources\CustomerComplaints\Pages;

use App\Filament\Resources\CustomerComplaints\CustomerComplaintResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewCustomerComplaint extends ViewRecord
{
    protected static string $resource = CustomerComplaintResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
