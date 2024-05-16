<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rating; 

class RateController extends Controller
{
    public function addRating(Request $request){

        // Pobierz dane z żądania
    $userData = $request->validate([
        'user_id' => 'required',
        'series_id' => 'required',
        'rating' => 'required'
    ]);

    // Sprawdź, czy użytkownik już ocenił ten serial
    $existingRating = Rating::where('user_id', $userData['user_id'])
                            ->where('series_id', $userData['series_id'])
                            ->exists();

    // Jeśli użytkownik już ocenił ten serial, zwróć odpowiedni komunikat
    if($existingRating) {
        return redirect('/home')->with('error', 'Nie możesz ocenić tego samego serialu więcej niż raz.');
    }

    // Jeśli użytkownik jeszcze nie ocenił tego serialu, dodaj ocenę do bazy danych
    $rating = new Rating();
    $rating->user_id = $userData['user_id'];
    $rating->series_id = $userData['series_id'];
    $rating->rating = $userData['rating'];
    $rating->save();

    // Przekieruj użytkownika z powrotem do strony domowej
    return redirect('/home')->with('success', 'Ocena została dodana pomyślnie.');
    }
}
