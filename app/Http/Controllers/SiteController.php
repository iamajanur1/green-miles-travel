<?php
namespace App\Http\Controllers;
use App\Models\{Trip,Category,Destination,Post,Testimonial,Setting};
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Response;
class SiteController extends Controller {
 public function home(){
  return view('home.index',[
   'categories'=>Category::where('is_active',true)->orderBy('sort_order')->get(),
   'trips'=>Trip::published()->where('is_featured',true)->orderBy('sort_order')->limit(3)->get(),
   'destinations'=>Destination::where('is_featured',true)->orderBy('sort_order')->limit(6)->get(),
   'testimonials'=>Testimonial::approved()->latest()->limit(4)->get(),
   'posts'=>Post::published()->latest('published_at')->limit(3)->get(),
  ]);
 }
 public function tours(Request $request){
  $category=$request->string('category')->toString();
  $q=Trip::published()->with('destination','categories');
  if($category){$q->whereHas('categories',fn($c)=>$c->where('slug',$category));}
  switch($request->string('sort')->toString()){
   case 'price-low':$q->orderBy('price_per_person');break;
   case 'price-high':$q->orderByDesc('price_per_person');break;
   default:$q->orderBy('sort_order')->orderBy('title');
  }
  return view('tours.index',['trips'=>$q->paginate(12)->withQueryString(),'categories'=>Category::where('is_active',true)->orderBy('sort_order')->get(),'currentCategory'=>$category]);
 }
 public function category(Category $category){abort_unless($category->is_active,404);return redirect()->route('tours',['category'=>$category->slug]);}
 public function tour(Trip $trip){abort_unless($trip->status==='published'&&(!$trip->publish_at||$trip->publish_at->isPast()),404);
  return view('tours.show',['trip'=>$trip->load(['destination','categories','departures']),'related'=>Trip::published()->where('id','!=',$trip->id)->limit(3)->get()]);}
 public function destinations(){return view('destinations.index',['destinations'=>Destination::orderBy('sort_order')->get()]);}
 public function destination(Destination $destination){return view('destinations.show',['destination'=>$destination,'trips'=>Trip::published()->where('destination_id',$destination->id)->get()]);}
 public function blog(){return view('blog.index',['posts'=>Post::published()->latest('published_at')->paginate(9)]);}
 public function post(Post $post){abort_unless($post->status==='published'&&$post->published_at?->isPast(),404);return view('blog.show',['post'=>$post]);}
 public function contact(Request $request){return view('pages.contact',['selectedTrip'=>Trip::published()->where('slug',$request->query('trip'))->first(),'trips'=>Trip::published()->orderBy('title')->get()]);}
 public function sitemap(){
  $urls=[url('/'),url('/about'),url('/tours'),url('/destinations'),url('/blog'),url('/contact')];
  foreach(Trip::published()->get(['slug']) as $t)$urls[]=route('tour.show',$t);
  foreach(Destination::all(['slug']) as $d)$urls[]=route('destination.show',$d);
  foreach(Post::published()->get(['slug']) as $a)$urls[]=route('blog.show',$a);
  $xml='<?xml version="1.0" encoding="UTF-8"?><urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
  foreach($urls as $url)$xml.='<url><loc>'.htmlspecialchars($url,ENT_XML1).'</loc></url>';
  return Response::make($xml.'</urlset>',200,['Content-Type'=>'application/xml; charset=utf-8']);
 }
}
