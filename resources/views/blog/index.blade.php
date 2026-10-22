@extends('layouts.site')
@section('title','Journal | Green Miles Travel')
@section('content')
<section class="inner-hero has-photo"><div class="container"><div class="crumb"><a href="{{route('home')}}">Home</a> / Journal</div><h1>Notes from<br><em>the open road.</em></h1><p>Small observations, travel stories and things we've learned on the trail.</p></div></section>
<section class="section"><div class="container"><div class="blog-grid">@forelse($posts as $post)<a href="{{route('blog.show',$post)}}" class="journal-card"><div class="journal-photo"><img src="{{ $post->cover_image ? asset('storage/'.$post->cover_image) : asset('assets/images/kapamodzu-flowers.webp') }}" alt="{{$post->title}}" loading="lazy"></div><div><span class="eyebrow">{{$post->published_at?->format('d M Y')}}</span><h3>{{$post->title}}</h3><p>{{$post->excerpt}}</p><span class="text-link">Read story ↗</span></div></a>@empty<div class="empty-state"><h2>More field notes soon.</h2><p>We're writing down the stories worth sharing.</p><a class="text-link" href="{{route('tours')}}">Discover our trips ↗</a></div>@endforelse</div><div class="page-links">{{$posts->links()}}</div></div></section>
@endsection
