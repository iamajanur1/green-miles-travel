<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Enquiry extends Model { protected $guarded=[]; protected function casts():array{return ['consent_at'=>'datetime'];} public function trip(){return $this->belongsTo(Trip::class);} }
