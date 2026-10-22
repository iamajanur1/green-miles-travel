<?php
namespace App\Models;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Filament\Auth\MultiFactor\App\Contracts\HasAppAuthentication;
use Filament\Auth\MultiFactor\App\Contracts\HasAppAuthenticationRecovery;
use Filament\Auth\MultiFactor\App\Concerns\InteractsWithAppAuthentication;
use Filament\Auth\MultiFactor\App\Concerns\InteractsWithAppAuthenticationRecovery;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
class User extends Authenticatable implements FilamentUser, HasAppAuthentication, HasAppAuthenticationRecovery {
 use Notifiable, InteractsWithAppAuthentication, InteractsWithAppAuthenticationRecovery;
 protected $fillable=['name','email','password','role','is_active'];
 protected $hidden=['password','remember_token'];
 protected function casts():array{return ['email_verified_at'=>'datetime','password'=>'hashed','is_active'=>'boolean'];}
 public function canAccessPanel(Panel $panel):bool{return $this->is_active && in_array($this->role,['owner','editor'],true);}
 public function isOwner():bool{return $this->role==='owner';}
}
