<?php
namespace App\Providers\Filament;
use Filament\Panel;
use Filament\View\PanelsRenderHook;
use Illuminate\Support\HtmlString;
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
 public function panel(Panel $panel):Panel {return $panel->default()->id('admin')->path('manage')->login()->multiFactorAuthentication([AppAuthentication::make()->recoverable()])->requiresMultiFactorAuthentication()->brandName('Green Miles Studio')->brandLogo(fn () => view('filament.partials.brand'))->brandLogoHeight('3rem')->favicon(asset('assets/images/logo.png'))->font('Inter Tight')->colors(['primary'=>'#1E4D2B'])->sidebarCollapsibleOnDesktop()
   ->renderHook(PanelsRenderHook::HEAD_END, fn () => new HtmlString('<link rel="stylesheet" href="'.asset('assets/admin-studio.css').'"><link rel="preconnect" href="https://fonts.googleapis.com"><link href="https://fonts.googleapis.com/css2?family=Inter+Tight:wght@400;500;600;700;800&amp;display=swap" rel="stylesheet">'))
   ->renderHook(PanelsRenderHook::CONTENT_START, fn () => request()->is('manage') ? view('filament.partials.studio-welcome') : '')
   ->discoverResources(in:app_path('Filament/Resources'),for:'App\\Filament\\Resources')
   ->pages([\Filament\Pages\Dashboard::class])->widgets([\App\Filament\Widgets\BusinessOverview::class])
   ->middleware([EncryptCookies::class,AddQueuedCookiesToResponse::class,StartSession::class,AuthenticateSession::class,ShareErrorsFromSession::class,VerifyCsrfToken::class,SubstituteBindings::class,DisableBladeIconComponents::class,DispatchServingFilamentEvent::class])
   ->authMiddleware([Authenticate::class]);}
}
