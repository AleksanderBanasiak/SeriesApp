<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class ManagerController extends Controller
{
    public function displayManager(){
            $users = \App\Models\User::where('role', 0)->get();
            return view('managerHome', ['users' => $users]);
    }

    public function enableUser($id){
        $user = User::findOrFail($id);
        $user->update(['enabled' => !$user->enabled]);
        return response()->json(['success' => true]);
    }

    public function showSeries($id){
        $user = User::findOrFail($id);
        return view('series/my-series', ['user' => $user]);
    }

}