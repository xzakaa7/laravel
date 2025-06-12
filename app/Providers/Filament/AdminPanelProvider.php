<?php

namespace App\Providers\Filament;

use App\Filament\Resources\DaruratResource;
use Filament\Pages;
use Filament\Panel;
use App\Models\User;
use Filament\Widgets;
use App\Models\Pengguna;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use App\Filament\Widgets\StatsOverview;
use App\Filament\Resources\NewsResource;
use App\Filament\Widgets\BlogPostsChart;
use App\Filament\Resources\EventResource;
use App\Filament\Resources\UsersResource;
use Filament\Http\Middleware\Authenticate;
use App\Filament\Resources\PenggunaResource;
use App\Filament\Resources\PengaduanResource;
use App\Filament\Resources\SuaramuResource;
use App\Filament\Widgets\PengaduanPerHariChart;
use App\Models\Suaramu;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Filament\Http\Middleware\AuthenticateSession;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Swis\Filament\Backgrounds\ImageProviders\MyImages;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Swis\Filament\Backgrounds\FilamentBackgroundsPlugin;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->login()
              ->sidebarFullyCollapsibleOnDesktop()
            ->resources([
                UsersResource::class,
                PenggunaResource::class,
                PengaduanResource::class,
                DaruratResource::class,
                SuaramuResource::class,
                EventResource::class,
                NewsResource::class

            ])
             ->plugins([
          FilamentBackgroundsPlugin::make()
                ->imageProvider(
                    MyImages::make()
                        ->directory('images/backgrounds/')
                ),
        ])
       
            ->colors([
                'primary' => Color::Sky,
            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
              //   Widgets\AccountWidget::class,
                // Widgets\FilamentInfoWidget::class,
                            StatsOverview::class,
                          //BlogPostsChart::class
                          PengaduanPerHariChart::class

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
            ])->plugins([
    \BezhanSalleh\FilamentShield\FilamentShieldPlugin::make(),
            ]);
    }

    
}
