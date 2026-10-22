<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Post extends Model { protected $guarded=[]; public function scopePublished($q){return $q->where('status','published')->where('published_at','<=',now());} protected function casts():array{return ['published_at'=>'datetime'];} }
