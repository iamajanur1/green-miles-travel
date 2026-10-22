<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Departure extends Model { protected $guarded=[]; public function trip(){return $this->belongsTo(Trip::class);} protected function casts():array{return ['starts_on'=>'date','ends_on'=>'date'];} }
