@extends('layouts.site')
@section('title',($destination->seo_title ?: $destination->name.' | Green Miles Travel'))
@section('description',($destination->seo_description ?: $destination->summary))
@section('content')
<section class="inner-hero has-photo"><div class="container"><div class="crumb"><a href="{{route('home')}}">Home</a> / <a href="{{route('destinations')}}">Destinations</a> / {{$destination->name}}</div><h1>Discover <em>{{$destination->name}}.</em></h1><p>{{$destination->summary}}</p></div></section>
<section class="section"><div class="container"><article class="content-article"><img class="feature-photo" src="{{ $destination->cover_image ? (str_starts_with($destination->cover_image,'assets/')?asset($destination->cover_image):asset('storage/'.$destination->cover_image)) : asset('assets/images/kapamodzu-flowers.webp') }}" alt="{{$destination->name}}" loading="lazy"><span class="eyebrow">THE PLACE</span><h2>{{$destination->name}}</h2><p>{{$destination->description ?: $destination->summary}}</p><h2>Best time to visit</h2><p>{{$destination->best_time ?? 'Get in touch for seasonal advice.'}}</p><h2>How to reach</h2><p>{{$destination->how_to_reach ?? 'We can help you plan a practical route. Ask for the latest travel arrangements.'}}</p></article></div></section>
@if($trips->count())<section class="section" style="background:#edf4e4"><div class="container"><div class="section-head"><span class="eyebrow">EXPLORE HERE</span><h2>Trips to <em>{{$destination->name}}.</em></h2></div><div class="trip-grid">@foreach($trips as $trip) @include('partials.trip-card',['trip'=>$trip]) @endforeach</div></div></section>@endif
@include('partials.cta')
@endsection
