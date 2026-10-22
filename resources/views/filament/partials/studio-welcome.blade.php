@php
  $newEnquiries = \App\Models\Enquiry::query()->where('status','new')->count();
  $latestEnquiries = \App\Models\Enquiry::query()->latest()->limit(4)->get();
@endphp
<div class="gm-admin-intro" role="region" aria-label="Green Miles travel studio overview">
  <div class="gm-admin-intro-content">
    <div class="gm-admin-intro-eyebrow"><span class="gm-live-pip" aria-hidden="true"></span> GREEN MILES · TRAVEL STUDIO</div>
    <h2>Good to see you, {{ auth()->user()?->name ? explode(' ',trim(auth()->user()->name))[0] : 'explorer' }}.</h2>
    <p>Everything for the next great North-East adventure lives here. Keep your packages fresh, answer enquiries, and announce what's coming.</p>
    <div class="gm-admin-quick-actions"><a href="{{\App\Filament\Resources\TripResource::getUrl('create')}}" class="gm-admin-primary-action">+ Create new trip <span aria-hidden="true">↗</span></a><a href="{{\App\Filament\Resources\AnnouncementResource::getUrl('index')}}" class="gm-admin-secondary-action">Manage announcements <span aria-hidden="true">→</span></a></div>
  </div>
  <div class="gm-admin-intro-art" aria-hidden="true"><img src="{{asset('assets/artwork/northeast-trail-map.svg')}}" alt=""><div class="gm-admin-art-caption">FOLLOW THE TRAIL <span>↗</span></div></div>
</div>
<div class="gm-admin-inline-section"><div><span class="gm-admin-kicker">OPERATIONS AT A GLANCE</span><h3>Business overview</h3></div><a href="{{\App\Filament\Resources\EnquiryResource::getUrl('index')}}">View all enquiries ↗</a></div>
@if($newEnquiries > 0)
 <div class="gm-admin-attention" role="status"><span aria-hidden="true">↗</span><strong>{{$newEnquiries}} {{\Illuminate\Support\Str::plural('enquiry',$newEnquiries)}} need your attention.</strong><a href="{{\App\Filament\Resources\EnquiryResource::getUrl('index')}}">Open inbox →</a></div>
@endif
@if($latestEnquiries->isNotEmpty())
<section class="gm-admin-recent" aria-label="Recent enquiries"><div class="gm-admin-recent-title"><div><span class="gm-admin-kicker">INBOX</span><h3>Recent enquiries</h3></div><a href="{{\App\Filament\Resources\EnquiryResource::getUrl('index')}}">See all →</a></div><div class="gm-admin-recent-list">
  @foreach($latestEnquiries as $enquiry)
  <div class="gm-admin-recent-row"><span class="gm-admin-person">{{strtoupper(mb_substr($enquiry->name ?? 'G',0,1))}}</span><div class="gm-admin-enquiry-name"><strong>{{$enquiry->name}}</strong><small>{{$enquiry->created_at?->diffForHumans()}} · {{ $enquiry->trip?->title ?? 'General enquiry' }}</small></div><span class="gm-admin-status gm-admin-status-{{$enquiry->status}}">{{ucfirst($enquiry->status)}}</span></div>
  @endforeach
 </div></section>
@endif
