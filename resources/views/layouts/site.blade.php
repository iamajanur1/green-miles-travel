<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
@php($pageTitle = trim($__env->yieldContent('title', $settings?->default_seo_title ?? 'Green Miles Travel | Explore North-East India')))
<title>{{ $pageTitle }}</title>
<meta name="description" content="@yield('description', $settings?->default_seo_description ?? 'Treks, culture and festivals across North-East India with Green Miles Travel.')">
<link rel="canonical" href="{{ url()->current() }}">
<meta property="og:type" content="website"><meta property="og:title" content="{{ $pageTitle }}"><meta property="og:image" content="{{ asset('assets/images/kapamodzu-flowers.webp') }}">
<meta name="theme-color" content="#1e4d2b"><link rel="icon" href="{{ asset('assets/images/logo.png') }}">
<link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Borel&family=Inter+Tight:wght@400;500;600;700;800&family=Kaushan+Script&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('assets/site.css') }}">
@if(file_exists(public_path('build/manifest.json'))) @vite(['resources/js/app.js']) @endif
<script defer src="{{ asset('assets/site.js') }}"></script>
<script type="application/ld+json">{!! json_encode(['@context'=>'https://schema.org','@type'=>'TravelAgency','name'=>'Green Miles Travel','url'=>url('/'),'telephone'=>$settings?->phone_primary,'sameAs'=>['https://www.instagram.com/greenmiles_travels/']],JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE) !!}</script>
@stack('head')
</head>
<body>
<a class="skip-link" href="#main">Skip to content</a>
<header class="site-header" id="siteHeader">
  <a href="{{ route('home') }}" class="brand" aria-label="Green Miles home"><img src="{{asset('assets/images/logo.png')}}" alt="Green Miles Travel" width="55" height="55"><span class="brand-name">GREEN MILES<small>TRAVEL · EXPLORE</small></span></a>
  <div class="header-actions"><a class="nav-plan" href="{{ route('contact') }}">Plan a trip <span aria-hidden="true">↗</span></a><button class="menu-toggle" id="menuToggle" type="button" aria-label="Open navigation" aria-expanded="false" aria-controls="siteMenu"><span></span><span></span></button></div>
  <nav class="menu-panel" id="siteMenu" aria-label="Main navigation" hidden>
    <a href="{{route('home')}}"><span class="menu-icon">⌂</span><span>Home<small>Where the trail begins</small></span><span class="menu-link-arrow">↗</span></a>
    <a href="{{route('tours')}}"><span class="menu-icon">↗</span><span>Explore trips<small>Treks, festivals and more</small></span><span class="menu-link-arrow">↗</span></a>
    <a href="{{route('destinations')}}"><span class="menu-icon">◎</span><span>Destinations<small>Discover the North-East</small></span><span class="menu-link-arrow">↗</span></a>
    <a href="{{route('about')}}"><span class="menu-icon">♧</span><span>Our story<small>Meet Green Miles</small></span><span class="menu-link-arrow">↗</span></a>
    <a href="{{route('blog')}}"><span class="menu-icon">✎</span><span>Journal<small>Notes from the road</small></span><span class="menu-link-arrow">↗</span></a>
    <a href="{{route('contact')}}" class="menu-contact">Let's plan your next escape <span>↗</span></a>
  </nav>
</header>
<main id="main">@yield('content')</main>
<footer class="footer" id="footer">
  <div class="footer-top container"><div class="footer-brand"><img src="{{ asset('assets/images/logo.png') }}" alt="Green Miles Travel" width="82" height="82"><h2>Go a little <em>further.</em></h2><p>Budget-friendly treks, cultural experiences and village trips across North-East India.</p><a href="https://www.instagram.com/greenmiles_travels/" target="_blank" rel="noopener noreferrer" class="social-pill">Instagram ↗</a></div>
  <div class="footer-col"><h3>EXPLORE</h3><a href="{{route('tours')}}">All trips</a><a href="{{route('destinations')}}">Destinations</a><a href="{{route('about')}}">About us</a><a href="{{route('blog')}}">Journal</a></div>
  <div class="footer-col"><h3>GOOD TO KNOW</h3><a href="{{route('contact')}}">Contact</a><a href="{{route('privacy')}}">Privacy policy</a><a href="{{route('terms')}}">Terms & conditions</a><a href="{{route('sitemap')}}">Sitemap</a></div>
  <div class="footer-col"><h3>GET IN TOUCH</h3><a href="tel:+91{{ $settings?->phone_primary ?? '6002529424' }}">+91 {{ $settings?->phone_primary ?? '6002529424' }}</a><a href="tel:+91{{ $settings?->phone_secondary ?? '7577853010' }}">+91 {{ $settings?->phone_secondary ?? '7577853010' }}</a><a href="https://wa.me/91{{ preg_replace('/\D/','',$settings?->whatsapp ?? '6002529424') }}" target="_blank" rel="noopener">WhatsApp the team ↗</a></div></div>
  <div class="footer-bottom container"><span>© {{date('Y')}} Green Miles Travel. Made for the open road.</span><span>NAGALAND · NORTH-EAST INDIA</span></div>
</footer>
@if($popup)
<div class="event-modal" id="eventModal" hidden aria-hidden="true"><div class="modal-scrim" data-close-modal></div><section class="event-dialog" role="dialog" aria-modal="true" aria-labelledby="eventTitle" tabindex="-1">
<button class="modal-x" type="button" data-close-modal aria-label="Close announcement">×</button>
<div class="event-dialog-photo"><img src="{{ $popup->image ? (str_starts_with($popup->image,'assets/') ? asset($popup->image) : asset('storage/'.$popup->image)) : asset('assets/images/hornbill-camping.webp') }}" alt="{{ $popup->title }}" loading="lazy"><span class="poster-stamp">GREEN MILES · WHAT'S NEXT?</span></div>
<div class="event-dialog-body"><span class="eyebrow">{{ $popup->eyebrow ?? 'COMING UP NEXT' }}</span><h2 id="eventTitle">{{ $popup->title }}</h2><p>{{ $popup->description }}</p>
<div class="modal-meta">@if($popup->event_date)<span>◷ {{ $popup->event_date->format('d M Y') }}</span>@endif @if($popup->location)<span>⌖ {{ $popup->location }}</span>@endif</div>
<div class="modal-bottom"><div>@if($popup->price_from)<small>STARTING AT</small><strong>₹{{ number_format($popup->price_from) }}</strong>@else<small>LET'S FIND YOUR SPOT</small><strong>Enquire now</strong>@endif</div><a class="button button-dark" href="{{ $popup->cta_url }}" data-book-event><span>{{ $popup->cta_label }}</span><b>↗</b></a></div><button type="button" class="quiet-link" data-close-modal>Maybe later</button></div></section></div>
@endif
<a class="floating-whatsapp" href="https://wa.me/91{{ preg_replace('/\D/','',$settings?->whatsapp ?? '6002529424') }}?text={{urlencode('Hi Green Miles! I would like to plan a trip.')}}" target="_blank" rel="noopener" aria-label="Chat with Green Miles on WhatsApp" title="WhatsApp us">✆</a>
</body></html>
