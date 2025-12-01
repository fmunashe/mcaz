<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\DefaultNoAccessMainDashboardWidget;
use App\Filament\Widgets\RegisteredClientsByLanguageChart;
use Filament\Pages\Dashboard as BaseDashboard;
use Filament\Pages\Dashboard\Concerns\HasFiltersAction;

class Dashboard extends BaseDashboard
{
    use HasFiltersAction;

    protected static ?string $title = 'Main dashboard';

    public function getWidgets(): array
    {
        if ($this->checkRole()) {
            return [
//                StatsOverview::class,
                RegisteredClientsByLanguageChart::class,
            ];
        }
        return [
            DefaultNoAccessMainDashboardWidget::class
        ];
    }

    public function getColumns(): int|array
    {
        return [
            'sm' => 1,
            'md' => 6,
            'xl' => 12,
        ];
    }

    private function checkRole()
    {
        return true;
        return auth()->user()->roles()->whereHas('permissions', function ($query) {
            $query->where('title', 'main_dashboard_access');
        })->exists();
    }
}
