<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Announcement extends Model { protected $guarded=[]; protected function casts():array{return ['is_active'=>'boolean','starts_at'=>'datetime','ends_at'=>'datetime','event_date'=>'date'];} }
