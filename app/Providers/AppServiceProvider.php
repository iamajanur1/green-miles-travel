<?php
namespace App\Providers;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Setting;
use App\Models\Announcement;
class AppServiceProvider extends ServiceProvider {
 public function register():void{}
 public function boot():void {
  // Minimal audit log without capturing visitors' private form contents.
  foreach ([\App\Models\Trip::class,\App\Models\Category::class,\App\Models\Destination::class,\App\Models\Departure::class,\App\Models\Post::class,\App\Models\Announcement::class,\App\Models\Testimonial::class,\App\Models\Setting::class] as $model){
   $model::saved(fn($row)=>$this->audit($row,$row->wasRecentlyCreated?'created':'updated'));
   $model::deleted(fn($row)=>$this->audit($row,'deleted'));
  }
  View::composer('*', function($view){
   static $loaded=false; static $settings=null; static $popup=null;
   if(!$loaded){
    try { $settings=Setting::query()->first();$popup=Announcement::query()->where('is_active',true)->where(fn($q)=>$q->whereNull('starts_at')->orWhere('starts_at','<=',now()))->where(fn($q)=>$q->whereNull('ends_at')->orWhere('ends_at','>=',now()))->orderByDesc('priority')->first(); }
    catch (\Throwable $e) {$settings=null;$popup=null;}
    $loaded=true;
   }
   $view->with(compact('settings','popup'));
  });
 }
 private function audit($row,string $action):void{ if(!\Illuminate\Support\Facades\Schema::hasTable('activity_logs'))return; try{\App\Models\ActivityLog::create(['user_id'=>auth()->id(),'action'=>$action,'model'=>get_class($row),'model_id'=>$row->getKey()]);}catch(\Throwable $e){report($e);} }
}
