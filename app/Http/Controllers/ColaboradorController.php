<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Colaborador;
class ColaboradorController extends Controller
{
    //

    public function store(Request $request)
    {

        $colaborator=new Colaborador;
        $colaborator->username=$request->username;
        $colaborator->firstname=$request->firstname;
        $colaborator->lastname=$request->lastname;
        $colaborator->email=$request->email;
        $colaborator->password=$request->password;
        $colaborator->address=$request->address;
        $colaborator->city=$request->city;
        $colaborator->country=$request->country;
        $colaborator->postal=$request->postal;
        $colaborator->about=$request->about;

        $colaborator->save();

        $colaborator=Colaborador::all();

        //return view('user-managment', ['users'=>$users])->with('succes','Usuario criado com Sucesso');
    }

}
