<?php

namespace App\Http\Controllers;
use App\Models\Series;
use App\Models\Rating;
use Illuminate\Http\Request;

class SeriesController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }

    public function create(){
        return view('series/create');
    }

    public function store(){

        $data = request()->validate([
            'name' => 'required',
            'description' => 'required',
            'yearOfRelease' => 'required',
            'numberOfSeasons' => 'required',
            'image' => ['required','image'],
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
            'description' => 'required',
            'yearOfRelease' => 'required',
            'numberOfSeasons' => 'required',
            'image' => ['required','image'],
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

}
