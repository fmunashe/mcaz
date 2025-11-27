<?php

namespace App\Filament\Resources\CustomerComplaints;

use App\Filament\Resources\CustomerComplaints\Pages\CreateCustomerComplaint;
use App\Filament\Resources\CustomerComplaints\Pages\EditCustomerComplaint;
use App\Filament\Resources\CustomerComplaints\Pages\ListCustomerComplaints;
use App\Filament\Resources\CustomerComplaints\Pages\ViewCustomerComplaint;
use App\Filament\Resources\CustomerComplaints\Schemas\CustomerComplaintForm;
use App\Filament\Resources\CustomerComplaints\Schemas\CustomerComplaintInfolist;
use App\Filament\Resources\CustomerComplaints\Tables\CustomerComplaintsTable;
use App\Models\CustomerComplaint;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class CustomerComplaintResource extends Resource
{
    protected static ?string $model = CustomerComplaint::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::ExclamationTriangle;

    protected static ?string $recordTitleAttribute = 'CustomerComplaint';

    public static function form(Schema $schema): Schema
    {
        return CustomerComplaintForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return CustomerComplaintInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CustomerComplaintsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListCustomerComplaints::route('/'),
            'create' => CreateCustomerComplaint::route('/create'),
            'view' => ViewCustomerComplaint::route('/{record}'),
            'edit' => EditCustomerComplaint::route('/{record}/edit'),
        ];
    }
}
