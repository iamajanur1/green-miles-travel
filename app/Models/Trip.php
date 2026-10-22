<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Trip extends Model {
 use SoftDeletes;
 protected $guarded=[];
 protected function casts():array{return ['itinerary'=>'array','inclusions'=>'array','exclusions'=>'array','faq'=>'array','gallery_images'=>'array','is_featured'=>'boolean','publish_at'=>'datetime'];}
 public function categories(){return $this->belongsToMany(Category::class);}
 public function destination(){return $this->belongsTo(Destination::class);}
 public function departures(){return $this->hasMany(Departure::class);}
 protected static function booted():void {static::saving(function(self $trip){
  if($trip->status==='published' && (!$trip->cover_image || !$trip->price_per_person && $trip->price_per_person!==0 || !is_array($trip->itinerary) || count($trip->itinerary)===0))
    throw \Illuminate\Validation\ValidationException::withMessages(['status'=>'Published trips need a cover image, price and itinerary.']);
 });}
 public function scopePublished($q){return $q->where('status','published')->where(fn($a)=>$a->whereNull('publish_at')->orWhere('publish_at','<=',now()));}
 public function getCoverUrlAttribute():string{return $this->cover_image?(str_starts_with($this->cover_image,'assets/')?asset($this->cover_image):asset('storage/'.$this->cover_image)):asset('assets/images/kapamodzu-flowers.webp');}
}
