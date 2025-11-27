<?php

namespace App\Providers\Filament;

use Filament\Enums\DatabaseNotificationsPosition;
use Filament\Enums\ThemeMode;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\MenuItem;
use Filament\Navigation\NavigationGroup;
use Filament\Pages\Dashboard;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Support\Enums\Width;
use Filament\Widgets\AccountWidget;
use Filament\Widgets\FilamentInfoWidget;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->databaseNotifications(position: DatabaseNotificationsPosition::Topbar)
            ->databaseNotificationsPolling('30s')
            ->id('admin')
            ->path('admin')
            ->registration()
            ->login()
            ->passwordReset()
            ->profile(isSimple: false)
            ->brandName('MCAZ')
            ->defaultThemeMode(ThemeMode::Light)
            ->topbar(true)
            ->userMenuItems([
                MenuItem::make()
                    ->label('Settings')
                    ->url('')
                    ->icon('heroicon-o-cog-6-tooth'),
            ])
            ->colors([
                'primary' => Color::rgb('rgb(47,31,80)'),
            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\Filament\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\Filament\Pages')
            ->pages([
                Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\Filament\Widgets')
            ->widgets([
                AccountWidget::class,
                FilamentInfoWidget::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ])
            ->sidebarFullyCollapsibleOnDesktop()
            ->brandLogo(asset('logo.png'))
            ->brandLogoHeight("50px")
            ->favicon(asset('logo.png'))
            ->maxContentWidth(Width::Full)
            ->navigationGroups([
                NavigationGroup::make()
                    ->label('Households')
                    ->icon('heroicon-o-user-group'),
                NavigationGroup::make()
                    ->label('Medical Dashboard')
                    ->icon('heroicon-s-plus'),
                NavigationGroup::make()
                    ->label('Assessments')
                    ->icon('heroicon-o-book-open'),

                NavigationGroup::make()
                    ->label('Forms')
                    ->icon('heroicon-o-pencil'),
                NavigationGroup::make()
                    ->label('Services')
                    ->icon('heroicon-o-sun'),
                NavigationGroup::make()
                    ->label('Commodity Dashboard')
                    ->icon('heroicon-o-truck'),
                NavigationGroup::make()
                    ->label('Call Centre')
                    ->icon('heroicon-o-phone'),
                NavigationGroup::make()
                    ->label('User Management')
                    ->icon('heroicon-o-user-group'),
//            ->icon('heroicon-o-key'),
                NavigationGroup::make()
                    ->label('Config Lists')
                    ->icon('heroicon-o-cog-6-tooth'),

                NavigationGroup::make()
                    ->label(fn(): string => __('navigation.settings'))
                    ->icon('heroicon-o-cog-6-tooth')
                    ->collapsed(),
            ]);
    }
}
