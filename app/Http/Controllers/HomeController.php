<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SavedSeries;

class HomeController extends Controller
{
  
    public function __construct()
    {
        $this->middleware('auth');
    }

  
    public function index()
    {
        return view('home');
    }


    public function saveSeries(Request $request)
    {
        // Sprawdź, czy użytkownik jest zalogowany
        if (!auth()->check()) {
            return response()->json(['status' => 'error', 'message' => 'Użytkownik nie jest zalogowany.'], 403);
        }
    
        $user = auth()->user();
        $seriesId = $request->input('series_id');
    
        // Sprawdź, czy serial nie jest już zapisany
        $existing = SavedSeries::where('user_id', $user->id)
                                ->where('series_id', $seriesId)
                                ->first();
    
        if ($existing) {
            return response()->json(['status' => 'error', 'message' => 'Ten serial jest już zapisany.'], 400);
        }
    
        // Zapisz serial
        SavedSeries::create([
            'user_id' => $user->id,
            'series_id' => $seriesId
        ]);
    
        return response()->json(['status' => 'success']);
    }

}
