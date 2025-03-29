<?php

namespace App\Http\Controllers;
use App\Models\Series;
use App\Models\Rating;
use Illuminate\Http\Request;
use App\Models\SavedSeries;

class SeriesController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }

    public function create(){
     
        return view('series/create' , ['enabled' => auth()->user()->enabled]);
      
        
    }

    public function store(){

      $data = request()->validate([
        'name' => 'required',
        'description' => 'required|min:10',
        'yearOfRelease' => 'required|integer|between:1990,' . date('Y'),
        'numberOfSeasons' => 'required|integer|between:1,50',
        'image' => ['required', 'image'],
        ]);
    

        $imagePath = request('image')->store('uploads', 'public');

        auth()->user()->series()->create([
          'name' => $data['name'],
          'description' => $data['description'],
          'yearOfRelease' => $data['yearOfRelease'],
          'numberOfSeasons' => $data['numberOfSeasons'],
          'image' => $imagePath
        ]);

        return redirect('/my-series/'.auth()->user()->id);
    }



    public function edit(Series $series){
        return view('/series/edit' , ['series' => $series]);
      }

      public function update(Series $series){
      
        $data = request()->validate([
        'name' => 'required',
        'description' => 'required|min:10',
        'yearOfRelease' => 'required|integer|between:1990,' . date('Y'),
        'numberOfSeasons' => 'required|integer|between:1,50',
        'image' => ['required', 'image'],
        ]);


        $imagePath = request('image')->store('uploads', 'public');

        $series->update([
          'name' => $data['name'],
          'description' => $data['description'],
          'yearOfRelease' => $data['yearOfRelease'],
          'numberOfSeasons' => $data['numberOfSeasons'],
          'image' => $imagePath
        ]);


        return redirect('/my-series/'.auth()->user()->id);
      }
  
  
      
      public function delete(Series $series){
        $series->delete();
        return redirect('/my-series/'.auth()->user()->id);
      }

      public function showSavedSeries()
    {
        $user = auth()->user(); 
       
        $savedSeries = SavedSeries::where('user_id', $user->id)->get();

        return view('saved_series', compact('savedSeries'));
    }


    public function deleteSavedSeries($id)
    {
        $user = auth()->user(); 
        $savedSeries = SavedSeries::where('user_id', $user->id)
                                  ->where('series_id', $id)
                                  ->first(); 

        if ($savedSeries) {
            $savedSeries->delete(); 
            return response()->json(['message' => 'Serial został usunięty z zapisanych.'], 200);
        }

        return response()->json(['message' => 'Nie znaleziono zapisanego serialu.'], 404);
    }


}
