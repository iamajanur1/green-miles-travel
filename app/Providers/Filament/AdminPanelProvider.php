<?php
namespace App\Providers\Filament;
use Filament\Panel;
use Filament\Auth\MultiFactor\App\AppAuthentication;
use Filament\PanelProvider;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
class AdminPanelProvider extends PanelProvider {
 public function panel(Panel $panel):Panel {return $panel->default()->id('admin')->path('manage')->login()->multiFactorAuthentication([AppAuthentication::make()->recoverable()])->requiresMultiFactorAuthentication()->brandName('Green Miles · Studio')->colors(['primary'=>'#1E4D2B'])
   ->discoverResources(in:app_path('Filament/Resources'),for:'App\\Filament\\Resources')
   ->pages([\Filament\Pages\Dashboard::class])->widgets([\App\Filament\Widgets\BusinessOverview::class])
   ->middleware([EncryptCookies::class,AddQueuedCookiesToResponse::class,StartSession::class,AuthenticateSession::class,ShareErrorsFromSession::class,VerifyCsrfToken::class,SubstituteBindings::class,DisableBladeIconComponents::class,DispatchServingFilamentEvent::class])
   ->authMiddleware([Authenticate::class]);}
}
