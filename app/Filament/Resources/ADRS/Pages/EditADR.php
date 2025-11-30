<?php

namespace App\Filament\Resources\ADRS\Pages;

use App\Filament\Resources\ADRS\ADRResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditADR extends EditRecord
{
    protected static string $resource = ADRResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }

    public function hasCombinedRelationManagerTabsWithContent(): bool
    {
        return false;
    }
}
