<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'username',
        'email',
        'password', 
        'role',
        'enabled'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
    
    public function series(){
        return $this->hasMany(Series::class);
    }


    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function savedSeries()
{
    return $this->hasMany(SavedSeries::class);
}

}
