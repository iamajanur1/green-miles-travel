<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Testimonial extends Model { protected $guarded=[]; public function scopeApproved($q){return $q->where('status','approved')->where('consent_given',true);} protected function casts():array{return ['consent_given'=>'boolean'];} }
