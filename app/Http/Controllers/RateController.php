<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rating; 

class RateController extends Controller
{
    public function addRating(Request $request){

    $userData = $request->validate([
        'user_id' => 'required',
        'series_id' => 'required',
        'rating' => 'required'
    ]);

    $existingRating = Rating::where('user_id', $userData['user_id'])
                            ->where('series_id', $userData['series_id'])
                            ->exists();

    if($existingRating) {
        return redirect('/')->with('error', 'Nie możesz ocenić tego samego serialu więcej niż raz.');
    }

    $rating = new Rating();
    $rating->user_id = $userData['user_id'];
    $rating->series_id = $userData['series_id'];
    $rating->rating = $userData['rating'];
    $rating->save();

    return redirect('/')->with('success', 'Ocena została dodana pomyślnie.');
    }
    
}
