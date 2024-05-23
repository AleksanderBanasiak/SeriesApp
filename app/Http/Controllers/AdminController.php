<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AdminController extends Controller
{
     
    public function displayAdmin(){
        $users = \App\Models\User::all();
        return view('adminHome', ['users' => $users]);
    }

    public function delete($id){
        $user = User::findOrFail($id);
        $user->delete();
        return response()->json(['success' => true, 'tr' => 'tr_'.$id]);
    }
}
