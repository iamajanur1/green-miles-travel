<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\{User,Setting,Category,Destination,Trip,Departure,Announcement};
class DatabaseSeeder extends Seeder { public function run():void {
 // Admin is never created with public/default credentials.
 if (env('ADMIN_EMAIL') && env('ADMIN_PASSWORD') && strlen((string) env('ADMIN_PASSWORD')) >= 12) {
   User::query()->firstOrCreate(['email'=>env('ADMIN_EMAIL')],['name'=>env('ADMIN_NAME','Green Miles Owner'),'password'=>Hash::make(env('ADMIN_PASSWORD')),'role'=>'owner','is_active'=>true]);
 }
 Setting::query()->firstOrCreate(['id'=>1],['socials'=>['instagram'=>'https://www.instagram.com/greenmiles_travels/'],'hero_image'=>'assets/images/kapamodzu-hero.webp','default_seo_title'=>'Green Miles Travel | Explore North-East India','default_seo_description'=>'Small group treks, culture and festival trips across Nagaland and North-East India.']);
 foreach ([['Treks','treks','Walk into the wild','footprints'],['Villages & Culture','villages-culture','Meet the communities','home'],['Nature','nature','Room to breathe','leaf'],['Weekend Getaways','weekend-getaways','Go this weekend','calendar'],['Budget Trips','budget-trips','More miles, less spend','wallet'],['Adventure','adventure','The good kind of unknown','compass']] as $a) Category::firstOrCreate(['slug'=>$a[1]],['name'=>$a[0],'tagline'=>$a[2],'icon'=>$a[3]]);
 foreach ([['Dzukou Valley','dzukou-valley','Nagaland','A valley of rolling hills and quiet trails.','June to September'],['Kapamodzu Peak','kapamodzu-peak','Pfütsero, Nagaland','Ridges, wildflowers and wide-open views.','October to April'],['Khonoma','khonoma','Nagaland','A village known for its living heritage and conservation.','October to April'],['Kisama','kisama','Kohima, Nagaland','Home of the annual Hornbill Festival.','December'],['Umrangso','umrangso','Dima Hasao, Assam','Hills and festival grounds at the edge of the wild.','December'],['Tawang','tawang','Arunachal Pradesh','High mountain roads and Himalayan views.','March to October'],['Haflong','haflong','Dima Hasao, Assam','Hill town escapes and quieter travel.','October to April'],['Mizoram','mizoram','Mizoram','Green ridgelines and small-town journeys.','October to March'],['Meghalaya','meghalaya','Meghalaya','Waterfalls, bridges and misty plateaus.','October to April']] as $d) Destination::firstOrCreate(['slug'=>$d[1]],['name'=>$d[0],'region'=>$d[2],'summary'=>$d[3],'best_time'=>$d[4],'is_featured'=>true,'cover_image'=>'assets/images/kapamodzu-flowers.webp']);
 // Prices and durations transcribed from user-provided flyers; treat as example listings pending operator verification.
 $trips=[
 ['Hornbill Festival Camping','hornbill-festival-camping','kisama',999,2,1,'Festival camping with breakfast, per person per night.','villages-culture'],
 ['Hornbill Festival Experience','hornbill-festival-experience','kisama',4999,3,2,'Festival performances, food and heritage around Kisama.','villages-culture'],
 ['Dzukou Valley Trek','dzukou-valley-trek','dzukou-valley',4499,2,1,'Hike through the green folds of Dzukou Valley.','treks'],
 ['Dzukou Valley Trek 3D/2N','dzukou-valley-three-days','dzukou-valley',5499,3,2,'More time on Dzukou’s trails, with space to explore.','treks'],
 ['Kapamodzu Peak Escape','kapamodzu-peak','kapamodzu-peak',4999,2,1,'A mountain escape near Pfütsero.','nature'],
 ['Khonoma Village Stay','khonoma-stay','khonoma',3999,3,2,'Slow travel and village landscapes in Nagaland.','villages-culture'],
 ['Tawang Discovery','tawang-discovery','tawang',14999,5,4,'Travel deeper into the eastern Himalaya.','adventure'],
 ['Haflong Weekend','haflong-weekend','haflong',2499,2,1,'A quick hill getaway from the plains.','weekend-getaways'],
 ['Meghalaya Trails','meghalaya-trails','meghalaya',5999,3,2,'Clouds, cliffs and easygoing exploration.','nature'],
 ['Falcon Festival Stay','falcon-festival-stay','umrangso',0,3,2,'Contact us for stay and festival trip options.','villages-culture'],
 ];
 foreach ($trips as $i=>$t) {
  $dest=Destination::where('slug',$t[2])->first();
  $trip=Trip::query()->firstOrCreate(['slug'=>$t[1]],[ 'title'=>$t[0],'summary'=>$t[6],'description'=>'Ask Green Miles for the current itinerary, confirmed inclusions and available departure dates.','destination_id'=>$dest?->id,'price_per_person'=>$t[3],'price_note'=>$t[3]?'from / person':'price on enquiry','duration_days'=>$t[4],'duration_nights'=>$t[5],'difficulty'=>in_array($t[2],['dzukou-valley','kapamodzu-peak'])?'moderate':'easy','start_point'=>'Confirm before booking','itinerary'=>[['day'=>1,'title'=>'Arrival and orientation','body'=>'Detailed itinerary confirmed with Green Miles before booking.']], 'inclusions'=>['Ask our team for confirmed inclusions'], 'exclusions'=>['Personal expenses unless listed otherwise'],'faq'=>[['question'=>'Is transport included?','answer'=>'Please confirm transport for your chosen departure.']],'cover_image'=> $t[2]=='kisama'?'assets/images/hornbill-camping.webp':($t[2]=='umrangso'?'assets/images/falcon-poster.webp':'assets/images/kapamodzu-flowers.webp'),'is_featured'=>$i<3,'status'=>'published','sort_order'=>$i]);
  $cat=Category::where('slug',$t[7])->first();if($cat)$trip->categories()->syncWithoutDetaching([$cat->id]);
 }
 $horn=Trip::where('slug','hornbill-festival-experience')->first();
 if($horn) Departure::firstOrCreate(['trip_id'=>$horn->id,'starts_on'=>'2026-12-01'],['ends_on'=>'2026-12-03','status'=>'enquire']);
 Announcement::firstOrCreate(['title'=>'Hornbill Festival 2026'],['eyebrow'=>'THE FESTIVAL OF FESTIVALS','description'=>'1–10 December 2026 · Kisama, Nagaland. Discover camping and festival packages.','image'=>'assets/images/hornbill-camping.webp','event_date'=>'2026-12-01','price_from'=>999,'location'=>'Kisama, Nagaland','cta_label'=>'Explore packages','cta_url'=>'/tours?category=villages-culture','is_active'=>true,'starts_at'=>'2026-10-22 00:00:00','ends_at'=>'2026-12-10 23:59:59','priority'=>10]);
 Announcement::firstOrCreate(['title'=>'Falcon Festival 2026'],['eyebrow'=>'UPCOMING · ASSAM','description'=>'11–13 December 2026 · Umrangso, Dima Hasao. Contact the team for stay options.','image'=>'assets/images/falcon-poster.webp','event_date'=>'2026-12-11','location'=>'Umrangso, Assam','cta_label'=>'Enquire now','cta_url'=>'/contact','is_active'=>false,'priority'=>5]);
 }}
