<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
class TesteController extends Controller
{
    //

    public function list(){

        $users=User::all();
        return view('pages.human-resources')->with(compact('users'));
    }

}
