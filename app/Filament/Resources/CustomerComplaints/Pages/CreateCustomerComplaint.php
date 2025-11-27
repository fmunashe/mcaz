<?php

namespace App\Filament\Resources\CustomerComplaints\Pages;

use App\Filament\Resources\CustomerComplaints\CustomerComplaintResource;
use Filament\Resources\Pages\CreateRecord;

class CreateCustomerComplaint extends CreateRecord
{
    protected static string $resource = CustomerComplaintResource::class;
}
