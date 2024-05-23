<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Series;
use App\Models\Rating;

class ViewController extends Controller
{    
    public function displayAll(){

        $series = Series::paginate(3); 

        if(request()->has('search')){
            $series = Series::all()->filter(function ($item) {
                return strpos($item->name, request()->input('search', '')) !== false;
            });
        }
        $avgRatings = [];
        $userRatings = [];
        $user = null;
            foreach ($series as $singleSeries) {
                $avgRatings[$singleSeries->id] = Rating::where('series_id', $singleSeries->id)
                ->avg('rating');
                if(auth()->user() != null){
                $userRatings[$singleSeries->id] = Rating::where('series_id', $singleSeries->id)
                ->where('user_id', auth()->user()->id)
                ->value('rating');
                $user = auth()->user();
                }
            }
        return view('home', ['series' => $series, 'ratings' => $avgRatings, 'userRatings' => $userRatings, 'user' => $user]);
    }



   

}
