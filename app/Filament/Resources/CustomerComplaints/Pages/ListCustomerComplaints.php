<?php

namespace App\Filament\Resources\CustomerComplaints\Pages;

use App\Filament\Resources\CustomerComplaints\CustomerComplaintResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListCustomerComplaints extends ListRecords
{
    protected static string $resource = CustomerComplaintResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
