@extends('layouts.site')
@section('title','Destinations | Green Miles Travel')
@section('content')
<section class="inner-hero has-photo"><div class="container"><div class="crumb"><a href="{{route('home')}}">Home</a> / Destinations</div><h1>The places that<br><em>stay with you.</em></h1><p>Mountains, valleys, cultures and quieter corners of the North-East.</p></div></section>
<section class="section"><div class="container"><div class="listing-grid">@foreach($destinations as $destination)<a href="{{route('destination.show',$destination)}}" class="location-card"><div class="location-photo"><img src="{{ $destination->cover_image ? (str_starts_with($destination->cover_image,'assets/')?asset($destination->cover_image):asset('storage/'.$destination->cover_image)) : asset('assets/images/kapamodzu-flowers.webp') }}" alt="{{$destination->name}}" loading="lazy"></div><div class="location-copy"><span class="eyebrow">{{$destination->region ?? 'NORTH-EAST INDIA'}}</span><h3>{{$destination->name}}</h3><p>{{$destination->summary}}</p><span class="text-link">Discover destination ↗</span></div></a>@endforeach</div></div></section>
@include('partials.cta')
@endsection
