<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class MySeriesController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }

    
    public function displaySeries($user){
      $authUser = User::find($user); 
      return view('series/my-series', ['user' => $authUser]);
    }



    


}
