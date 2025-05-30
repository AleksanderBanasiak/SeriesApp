<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SavedSeries extends Model
{
    use HasFactory;

   protected $fillable = [
    'user_id',
    'series_id'
];


public function user()
{
    return $this->belongsTo(User::class);
}


public function series()
{
    return $this->belongsTo(Series::class);
}

}
