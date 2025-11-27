<?php

namespace App\Filament\Resources\CustomerComplaints\Pages;

use App\Filament\Resources\CustomerComplaints\CustomerComplaintResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditCustomerComplaint extends EditRecord
{
    protected static string $resource = CustomerComplaintResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
