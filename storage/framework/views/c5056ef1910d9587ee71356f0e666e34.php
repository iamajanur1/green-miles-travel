<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
<?php ($pageTitle = trim($__env->yieldContent('title', $settings?->default_seo_title ?? 'Green Miles Travel | Explore North-East India'))); ?>
<title><?php echo e($pageTitle); ?></title>
<meta name="description" content="<?php echo $__env->yieldContent('description', $settings?->default_seo_description ?? 'Treks, culture and festivals across North-East India with Green Miles Travel.'); ?>">
<link rel="canonical" href="<?php echo e(url()->current()); ?>">
<meta property="og:type" content="website"><meta property="og:title" content="<?php echo e($pageTitle); ?>"><meta property="og:image" content="<?php echo e(asset('assets/images/kapamodzu-flowers.webp')); ?>">
<meta name="theme-color" content="#1e4d2b"><link rel="icon" href="<?php echo e(asset('assets/images/logo.png')); ?>">
<link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Borel&family=Inter+Tight:wght@400;500;600;700;800&family=Kaushan+Script&display=swap" rel="stylesheet">
<link rel="stylesheet" href="<?php echo e(asset('assets/site.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('assets/lux.css')); ?>">
<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(file_exists(public_path('build/manifest.json'))): ?> <?php echo app('Illuminate\Foundation\Vite')(['resources/js/app.js']); ?> <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
<script defer src="<?php echo e(asset('assets/site.js')); ?>"></script>
<script defer src="<?php echo e(asset('assets/lux.js')); ?>"></script>
<script type="application/ld+json"><?php echo json_encode(['<?php $__contextArgs = [];
if (context()->has($__contextArgs[0])) :
if (isset($value)) { $__contextPrevious[] = $value; }
$value = context()->get($__contextArgs[0]); ?>'=>'https://schema.org','@type'=>'TravelAgency','name'=>'Green Miles Travel','url'=>url('/'),'telephone'=>$settings?->phone_primary,'sameAs'=>['https://www.instagram.com/greenmiles_travels/']],JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE); ?></script>
<?php echo $__env->yieldPushContent('head'); ?>
</head>
<body>
<a class="skip-link" href="#main">Skip to content</a>
<header class="site-header lux-nav" id="siteHeader">
  <a href="<?php echo e(route('home')); ?>" class="brand lux-brand" aria-label="Green Miles home"><img src="<?php echo e(asset('assets/images/logo.png')); ?>" alt="Green Miles Travel logo" width="50" height="50"><span class="brand-name">Green Miles<small>TRAVEL · EXPLORE</small></span></a>
  <button class="menu-toggle lux-menu-toggle" id="menuToggle" type="button" aria-label="Open navigation" aria-expanded="false" aria-controls="siteMenu"><span></span><span></span></button>
  <a class="nav-plan lux-nav-cta" href="<?php echo e(route('contact')); ?>">Plan a Trip <span aria-hidden="true">➜</span></a>
  <nav class="menu-panel lux-menu-panel" id="siteMenu" aria-label="Main navigation" hidden>
    <a href="<?php echo e(route('home')); ?>"><span class="menu-icon">⌂</span><span>Home<small>Where the trail begins</small></span><span class="menu-link-arrow">↗</span></a>
    <a href="<?php echo e(route('tours')); ?>"><span class="menu-icon">↗</span><span>Explore Trips<small>Treks, festivals and more</small></span><span class="menu-link-arrow">↗</span></a>
    <a href="<?php echo e(route('destinations')); ?>"><span class="menu-icon">◎</span><span>Destinations<small>Discover the North-East</small></span><span class="menu-link-arrow">↗</span></a>
    <a href="<?php echo e(route('about')); ?>"><span class="menu-icon">♧</span><span>About Us<small>Our story and values</small></span><span class="menu-link-arrow">↗</span></a>
    <a href="<?php echo e(route('blog')); ?>"><span class="menu-icon">✎</span><span>Journal<small>Notes from the road</small></span><span class="menu-link-arrow">↗</span></a>
    <a href="<?php echo e(route('contact')); ?>" class="menu-contact">Plan your journey <span>↗</span></a>
  </nav>
</header>
<main id="main"><?php echo $__env->yieldContent('content'); ?></main>
<footer class="footer lux-footer" id="footer"><div class="lux-container lux-footer-inner">
  <div class="lux-footer-brand"><a href="<?php echo e(route('home')); ?>" class="footer-logo"><img src="<?php echo e(asset('assets/images/logo.png')); ?>" alt="Green Miles Travel" width="65" height="65"><span>Green Miles<small>TRAVEL · EXPLORE</small></span></a><p>Budget-friendly treks, beautiful landscapes and cultural experiences across North-East India.</p><div class="footer-socials"><a href="https://www.instagram.com/greenmiles_travels/" target="_blank" rel="noopener noreferrer" aria-label="Instagram">ig</a><a href="https://wa.me/91<?php echo e(preg_replace('/\D/','',$settings?->whatsapp ?? '6002529424')); ?>" target="_blank" rel="noopener noreferrer" aria-label="WhatsApp">wa</a></div></div>
  <div class="lux-footer-column"><h3>Pages</h3><a href="<?php echo e(route('home')); ?>">Home</a><a href="<?php echo e(route('about')); ?>">About Us</a><a href="<?php echo e(route('tours')); ?>">Tours</a><a href="<?php echo e(route('destinations')); ?>">Destinations</a><a href="<?php echo e(route('blog')); ?>">Journal</a><a href="<?php echo e(route('contact')); ?>">Contact</a></div>
  <div class="lux-footer-column"><h3>Utility</h3><a href="<?php echo e(route('privacy')); ?>">Privacy</a><a href="<?php echo e(route('terms')); ?>">Terms</a><a href="<?php echo e(route('sitemap')); ?>">Sitemap</a><a href="<?php echo e(route('contact')); ?>">Plan a Trip</a></div>
  <div class="lux-footer-column lux-footer-contact"><h3>Contact Us</h3><p>Nagaland, North-East India</p><a href="tel:+91<?php echo e(preg_replace('/\D/','',$settings?->phone_primary ?? '6002529424')); ?>">+91 <?php echo e($settings?->phone_primary ?? '6002529424'); ?></a><a href="tel:+91<?php echo e(preg_replace('/\D/','',$settings?->phone_secondary ?? '7577853010')); ?>">+91 <?php echo e($settings?->phone_secondary ?? '7577853010'); ?></a><a href="https://www.instagram.com/greenmiles_travels/" target="_blank" rel="noopener noreferrer">@greenmiles_travels ↗</a></div>
</div><div class="lux-container lux-footer-bottom"><span>© <?php echo e(date('Y')); ?> Green Miles Travel. All rights reserved.</span><span>Made for the mountains of North-East India</span></div></footer>
<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($popup): ?>
<div class="event-modal" id="eventModal" hidden aria-hidden="true"><div class="modal-scrim" data-close-modal></div><section class="event-dialog" role="dialog" aria-modal="true" aria-labelledby="eventTitle" tabindex="-1">
<button class="modal-x" type="button" data-close-modal aria-label="Close announcement">×</button>
<div class="event-dialog-photo"><img src="<?php echo e($popup->image ? (str_starts_with($popup->image,'assets/') ? asset($popup->image) : asset('storage/'.$popup->image)) : asset('assets/images/hornbill-camping.webp')); ?>" alt="<?php echo e($popup->title); ?>" loading="lazy"><span class="poster-stamp">GREEN MILES · WHAT'S NEXT?</span></div>
<div class="event-dialog-body"><span class="eyebrow"><?php echo e($popup->eyebrow ?? 'COMING UP NEXT'); ?></span><h2 id="eventTitle"><?php echo e($popup->title); ?></h2><p><?php echo e($popup->description); ?></p>
<div class="modal-meta"><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($popup->event_date): ?><span>◷ <?php echo e($popup->event_date->format('d M Y')); ?></span><?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?> <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($popup->location): ?><span>⌖ <?php echo e($popup->location); ?></span><?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?></div>
<div class="modal-bottom"><div><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($popup->price_from): ?><small>STARTING AT</small><strong>₹<?php echo e(number_format($popup->price_from)); ?></strong><?php else: ?><small>LET'S FIND YOUR SPOT</small><strong>Enquire now</strong><?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?></div><a class="button button-dark" href="<?php echo e($popup->cta_url); ?>" data-book-event><span><?php echo e($popup->cta_label); ?></span><b>↗</b></a></div><button type="button" class="quiet-link" data-close-modal>Maybe later</button></div></section></div>
<?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
<a class="floating-whatsapp" href="https://wa.me/91<?php echo e(preg_replace('/\D/','',$settings?->whatsapp ?? '6002529424')); ?>?text=<?php echo e(urlencode('Hi Green Miles! I would like to plan a trip.')); ?>" target="_blank" rel="noopener" aria-label="Chat with Green Miles on WhatsApp" title="WhatsApp us">✆</a>
</body></html>
<?php /**PATH /Users/apple/Documents/green miles/green-miles-travel/resources/views/layouts/site.blade.php ENDPATH**/ ?>