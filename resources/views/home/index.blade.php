@extends('layouts.site')
@section('title','Green Miles Travel | Explore the North-East')
@section('description','Thoughtfully planned treks, festivals, village experiences and budget-friendly journeys across North-East India.')
@section('content')
@php
  $image = fn($value, $fallback='assets/images/kapamodzu-flowers.webp') => $value ? (str_starts_with($value,'assets/') ? asset($value) : asset('storage/'.$value)) : asset($fallback);
  $categoryPhotos = ['assets/images/kapamodzu-wildflowers.webp','assets/images/hornbill-camping.webp','assets/images/kapamodzu-flowers.webp','assets/images/kapamodzu-hills.webp','assets/images/durga-packages.webp','assets/images/kapamodzu-wildflowers.webp'];
@endphp
<section class="hero hero-home lux-hero" aria-label="Welcome to Green Miles Travel">
  <div class="hero-backdrop" style="background-image:url('{{ $image($settings?->hero_image,'assets/images/kapamodzu-hero.webp') }}')"></div>
  <div class="hero-shade"></div>
  <div class="container lux-hero-content">
    <span class="paper-label paper-label-blue">Trekking · Culture · North-East India</span>
    <h1 data-reveal="hero">Your Greatest<br><em>Adventure</em> Awaits</h1>
    <p>{{ $settings?->hero_body ?? 'Explore the hills, living cultures and beautiful trails of North-East India, one honest trip at a time.' }}</p>
    <a class="lux-button lux-button-white" href="{{route('tours')}}"><span>Start Exploring</span><b aria-hidden="true">➜</b></a>
    <span class="hero-location">KAPAMODZU · NAGALAND <span aria-hidden="true">↗</span></span>
  </div>
  <img class="hero-paper-edge" src="{{asset('assets/artwork/torn-edge-white.svg')}}" alt="" aria-hidden="true">
</section>
<section class="lux-section lux-experiences" id="experiences">
  <div class="lux-container">
    <header class="lux-center-heading" data-reveal="heading">
      <span class="paper-label">Explore Experiences</span>
      <h2>Find <em>Experiences</em><br>You'll Love</h2>
    </header>
    <div class="arch-gallery">
      <button type="button" class="slider-side-button" data-experiences-prev aria-label="Previous experiences">‹</button>
      <div class="arch-viewport" data-experiences-slider>
        <div class="arch-track">
          @foreach($categories as $i=>$category)
          <a class="arch-card" href="{{route('category.show',$category)}}" aria-label="Explore {{$category->name}}">
            <div class="arch-image"><img src="{{$image($category->cover_image, $categoryPhotos[$i%6])}}" alt="{{$category->name}} in North-East India" loading="lazy"><span class="arch-icon" aria-hidden="true"><svg viewBox="0 0 24 24"><path d="m3 18 6-11 4 7 3-5 5 9H3Z"/><path d="m6 18 3-5 2 3"/></svg></span></div>
            <h3>{{$category->name}}</h3><p>{{$category->tagline}}</p>
          </a>
          @endforeach
        </div>
      </div>
      <button type="button" class="slider-side-button" data-experiences-next aria-label="Next experiences">›</button>
    </div>
    <a class="lux-button lux-button-ink" href="{{route('tours')}}"><span>Browse Categories</span><b aria-hidden="true">➜</b></a>
  </div>
</section>
<section class="lux-section lux-why" id="why-green-miles">
 <div class="lux-container">
  <header class="lux-center-heading" data-reveal="heading"><span class="paper-label">Why Travel With Us</span><h2>Every journey begins<br>with <em>thoughtful</em> planning.</h2></header>
  <div class="signpost-composition">
    <svg class="signpost-route" viewBox="0 0 1200 600" aria-hidden="true"><path d="M80 90C-10 220 150 230 270 210S475 450 300 480 105 390 130 375M1130 125c-200-130-165 220-45 240 155 25 60 160-140 95S750 530 820 560" fill="none" stroke="#c9a36b" stroke-width="2" stroke-dasharray="9 13"/></svg>
    <div class="signpost-decoration signpost-plane" aria-hidden="true"><svg viewBox="0 0 40 40"><path d="m2 21 36-18-9 34-7-13-20-3Z" fill="#b8a77e"/><path d="m22 24-12 11 2-13" fill="#d4c49e"/></svg></div>
    <div class="signpost-decoration signpost-stamp" aria-hidden="true">NORTH<br>EAST<br>INDIA</div>
    <div class="signpost-post" aria-hidden="true"></div>
    <div class="signpost-list">
      <article class="signpost signpost-one" data-reveal="card"><span class="sign-icon"><svg viewBox="0 0 24 24"><circle cx="12" cy="5" r="2"/><path d="m12 8-3 4-4 2m4-2 5 2 4 6M9 12l-2 8M4 21h17"/></svg></span><div><h3>Local Travel Knowledge</h3><p>Travel planning shaped around real places and people.</p></div></article>
      <article class="signpost signpost-two" data-reveal="card"><span class="sign-icon"><svg viewBox="0 0 24 24"><rect x="4" y="8" width="16" height="13" rx="2"/><path d="M9 8V5a3 3 0 0 1 6 0v3M4 12h16"/></svg></span><div><h3>Trips Made for You</h3><p>Treks, culture and weekends that fit your pace.</p></div></article>
      <article class="signpost signpost-three" data-reveal="card"><span class="sign-icon"><svg viewBox="0 0 24 24"><path d="M3 18 9 5l5 10 3-6 4 9M3 21h18M9 9l2 3"/></svg></span><div><h3>Honest Starting Prices</h3><p>Clear details and a real person to speak with.</p></div></article>
      <article class="signpost signpost-four" data-reveal="card"><span class="sign-icon"><svg viewBox="0 0 24 24"><path d="m12 21 7-4V5l-7 4-7-4v12l7 4Zm0-12v12"/><path d="m8 12 2 2 5-5"/></svg></span><div><h3>Here for the Whole Trip</h3><p>Ask questions and plan the details before you go.</p></div></article>
    </div>
    <svg class="signpost-hills" viewBox="0 0 400 80" aria-hidden="true"><path d="m0 80 80-41 35 18L183 7l80 58 50-31 87 46Z" fill="#d0d6cd"/><path d="m65 80 93-54 38 27 55-18 86 45Z" fill="#a6b8a5"/></svg>
  </div>
 </div>
</section>
<section class="lux-section lux-featured" id="featured">
 <div class="lux-container">
  <header class="lux-split-heading" data-reveal="heading"><div><span class="paper-label">Featured Tours</span><h2>Journeys <em>Designed</em> For Every<br class="desktop-only"> Explorer</h2></div><a href="{{route('tours')}}" class="lux-button lux-button-ink"><span>Explore All Tours</span><b aria-hidden="true">➜</b></a></header>
  <div class="lux-polaroid-grid">@forelse($trips as $trip) @include('partials.trip-card',['trip'=>$trip]) @empty <div class="lux-empty">New adventures are in the works. <a href="{{route('contact')}}">Ask what's coming next.</a></div> @endforelse</div>
 </div>
</section>
<section class="lux-adventure" id="next-adventure">
 <img src="{{asset('assets/artwork/torn-edge-white.svg')}}" class="adventure-edge" aria-hidden="true" alt="">
 <div class="lux-container adventure-inner"><div class="adventure-copy" data-reveal="heading"><span class="paper-label paper-label-blue">Start Your Journey</span><h2>Your Next Great<br><em>Adventure</em> Starts</h2><a class="lux-button lux-button-white" href="{{route('destinations')}}"><span>Start Exploring</span><b aria-hidden="true">➜</b></a></div><div class="adventure-images"><figure><img src="{{asset('assets/images/kapamodzu-wildflowers.webp')}}" alt="Wildflowers on the hills in Nagaland" loading="lazy"></figure><figure><img src="{{asset('assets/images/kapamodzu-hills.webp')}}" alt="Green hills of Nagaland" loading="lazy"></figure><figure><img src="{{asset('assets/images/kapamodzu-flowers.webp')}}" alt="Kapamodzu wildflowers" loading="lazy"></figure><div class="adventure-stamp" aria-hidden="true">EXPLORE<br>MORE<br>↗</div></div></div>
</section>
<div class="ribbon-crossing" aria-label="Places to explore across North-East India"><div class="ribbon ribbon-one"><div class="ribbon-content">KOHIMA <span>✦</span> MEGHALAYA <span>✦</span> TAWANG <span>✦</span> KOHIMA <span>✦</span> MEGHALAYA <span>✦</span> TAWANG <span>✦</span></div></div><div class="ribbon ribbon-two"><div class="ribbon-content">DZUKOU VALLEY <span>✦</span> KAPAMODZU <span>✦</span> KHONOMA <span>✦</span> DZUKOU VALLEY <span>✦</span> KAPAMODZU <span>✦</span> KHONOMA <span>✦</span></div></div></div>
<section class="lux-section lux-destinations" id="destinations"><div class="lux-container"><header class="lux-center-heading" data-reveal="heading"><span class="paper-label">Discover The North-East</span><h2>Discover Places <em>Worth</em><br>The Journey.</h2></header>
 <div class="lux-destination-slider" data-slider="destinations"><button type="button" class="slider-side-button" data-prev aria-label="Previous destination">‹</button><div class="dest-slides">
 @foreach($destinations as $index=>$destination)
 <article class="lux-destination-slide @if($loop->first) is-active @endif" data-slide><div class="dest-side-photo dest-left"><img src="{{$image($destination->cover_image,'assets/images/kapamodzu-wildflowers.webp')}}" alt="{{$destination->name}} landscape" loading="lazy"></div><div class="dest-central"><div class="dest-central-top"><span>0{{$index+1}} / EXPLORE</span><span>NORTH-EAST INDIA</span></div><h3>{{$destination->name}}</h3><p>{{$destination->summary}}</p><p class="dest-location">⌖ {{ $destination->region ?? 'North-East India' }}</p><div class="dest-central-bottom"><a class="lux-button lux-button-forest" href="{{route('destination.show',$destination)}}"><span>View Destination</span><b aria-hidden="true">➜</b></a></div></div><div class="dest-side-photo dest-right"><img src="{{asset('assets/images/kapamodzu-flowers.webp')}}" alt="Flowers and landscapes in the North-East" loading="lazy"></div></article>
 @endforeach
 </div><button type="button" class="slider-side-button" data-next aria-label="Next destination">›</button></div><div class="destination-pagination"><span class="slider-current">01 / {{sprintf('%02d',max(1,$destinations->count()))}}</span></div></div></section>
<section class="lux-section lux-milestones"><div class="lux-container milestone-editorial"><div class="milestone-stats" data-reveal="heading"><span class="paper-label">Milestones We're Building</span><h2>Small steps.<br><em>Real adventures.</em></h2><div class="milestone-major"><strong data-count="{{ $trips->count() }}">{{ $trips->count() }}</strong><span>Featured trips to discover</span></div><img class="north-east-outline" src="{{asset('assets/artwork/northeast-trail-map.svg')}}" alt="Decorative map-style illustration of a trail across North-East India"><div class="milestone-minor"><div><strong>{{ $categories->count() }}</strong><span>Ways to explore</span></div><div><strong>{{ $destinations->count() }}</strong><span>Featured places</span></div></div><p class="milestone-honesty">Every trail starts somewhere. Ask our team about available dates, group sizes and the right trip for you.</p></div><div class="milestone-photo-stack"><figure><img src="{{asset('assets/images/kapamodzu-hills.webp')}}" alt="Mountain ridges in Nagaland" loading="lazy"><figcaption>Kapamodzu, Nagaland</figcaption></figure><figure><img src="{{asset('assets/images/kapamodzu-wildflowers.webp')}}" alt="Wildflowers on mountain slopes" loading="lazy"><figcaption>Wildflower trails</figcaption></figure><figure><img src="{{asset('assets/images/hornbill-camping.webp')}}" alt="Hornbill Festival camping package" loading="lazy"><figcaption>Hornbill Festival</figcaption></figure></div></div></section>
<section class="lux-section lux-stories"><div class="lux-container stories-editorial"><div data-reveal="heading"><span class="paper-label">Traveler Stories</span><h2><em>Stories</em> That Stay<br>With You</h2><p>Real people. Real memories. We'll share their words here with permission.</p><a href="{{route('contact')}}" class="lux-text-link">Tell us about your trip ↗</a></div><div class="review-display">@forelse($testimonials as $item)<div class="review-paper"><div class="review-photo"><img src="{{asset('assets/images/kapamodzu-flowers.webp')}}" alt="North-East landscape" loading="lazy"></div><div class="review-words"><div class="review-stars" aria-label="{{$item->rating}} out of 5 stars">{{str_repeat('★',max(0,min(5,$item->rating)))}}</div><strong>{{$item->name}}</strong><small>{{$item->city}}</small><p>“{{$item->quote}}”</p></div></div>@break @empty<div class="review-paper review-pending"><div class="review-photo"><img src="{{asset('assets/images/kapamodzu-wildflowers.webp')}}" alt="Nagaland flowering hills" loading="lazy"></div><div class="review-words"><span class="paper-label">From the trail</span><h3>Stories are better<br>when they're shared.</h3><p>Traveler reviews will appear here after we receive permission to publish them.</p><a href="{{route('contact')}}" class="lux-text-link">Share your story ↗</a></div></div>@endforelse</div></div></section>
<section class="lux-section lux-journal"><div class="lux-container"><header class="lux-split-heading"><div><span class="paper-label">Journey Notes</span><h2>The <em>Explorer's</em> Journal</h2></div><a href="{{route('blog')}}" class="lux-button lux-button-ink"><span>Read Journal</span><b aria-hidden="true">➜</b></a></header>
<div class="editorial-grid">@forelse($posts as $post)<a class="editorial-card" href="{{route('blog.show',$post)}}"><img src="{{$image($post->cover_image,'assets/images/kapamodzu-flowers.webp')}}" alt="{{$post->title}}" loading="lazy"><div class="editorial-card-copy"><small>{{$post->published_at?->format('d F Y')}}</small><h3>{{$post->title}}</h3><p>{{$post->excerpt}}</p></div></a>@empty<a class="editorial-card editorial-intro-card" href="{{route('destinations')}}"><img src="{{asset('assets/images/kapamodzu-wildflowers.webp')}}" alt="Wildflowers in Nagaland" loading="lazy"><div class="editorial-card-copy"><small>FIELD NOTES</small><h3>Where the wildflowers grow</h3><p>Discover the hills and trails of Nagaland.</p></div></a><a class="editorial-card editorial-intro-card" href="{{route('tours')}}"><img src="{{asset('assets/images/kapamodzu-hills.webp')}}" alt="Green mountain ridge" loading="lazy"><div class="editorial-card-copy"><small>EXPLORE NORTH-EAST INDIA</small><h3>Find your next trail</h3><p>See our upcoming trekking and culture packages.</p></div></a><a class="editorial-card editorial-intro-card" href="{{route('contact')}}"><img src="{{asset('assets/images/hornbill-camping.webp')}}" alt="Hornbill Festival information" loading="lazy"><div class="editorial-card-copy"><small>GREEN MILES TRAVEL</small><h3>Let's plan a trip</h3><p>Ask us about dates, inclusions and group packages.</p></div></a>@endforelse</div></div></section>
@include('partials.cta')
@endsection
