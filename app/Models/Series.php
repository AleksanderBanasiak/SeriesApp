<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Series extends Model
{
    use HasFactory;
    protected $guarded =[];

    

    public function users(){
        return $this->belongTo(User::class);
    }

    public function savedByUsers()
{
    return $this->hasMany(SavedSeries::class);
}
}
