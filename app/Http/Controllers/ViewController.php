<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Series;
use App\Models\Rating;

class ViewController extends Controller
{    
    public function displayAll(Request $request)
    {
        // Ustawienia ilości elementów na stronę
        $perPage = $request->input('per_page', 3); // Domyślnie 3 elementy na stronę
        $sortField = $request->input('sort', 'name'); // Domyślne sortowanie po nazwie
        $sortOrder = $request->input('order', 'asc'); // Domyślny kierunek sortowania akurat tutaj rosnąco

        $query = Series::query();
       
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('name', 'like', '%' . $search . '%');
        }

        // Sortowanie
        $query->orderBy($sortField, $sortOrder);

        // Pobranie serii z paginacją
        $series = $query->paginate($perPage)->appends($request->except('page'));

        $avgRatings = [];
        $userRatings = [];
        $user = null;

        foreach ($series as $singleSeries) {
            $avgRatings[$singleSeries->id] = Rating::where('series_id', $singleSeries->id)
                ->avg('rating');
            if (auth()->check()) {
                $userRatings[$singleSeries->id] = Rating::where('series_id', $singleSeries->id)
                    ->where('user_id', auth()->id())
                    ->value('rating');
                $user = auth()->user();
            }
        }

        return view('home', [
            'series' => $series,
            'ratings' => $avgRatings,
            'userRatings' => $userRatings,
            'user' => $user,
            'perPage' => $perPage,
            'sortField' => $sortField,
            'sortOrder' => $sortOrder
        ]);



      


    }
}
