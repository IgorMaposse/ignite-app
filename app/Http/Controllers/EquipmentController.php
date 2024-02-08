<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Equipment;
class EquipmentController extends Controller
{
    //

    public function index(){


              $equipments=Equipment::all();

             return view('pages.equipment', ['equipments'=>$equipments]);
         }

    public function store( Request $request){
        $equipment = new Equipment;
        $equipment->name=$request->name;

        $equipment->cod=$request->cod;


        if ($request->file('image') && $request->file('image')->isValid()) {
            $requestImage = $request->file('image');

            // Get the file path
            $filePath = $requestImage->path();

            // Hash the file contents
            $hash = hash_file('md5', $filePath);

            // Rest of your code
            $extension = $requestImage->extension();
            $imageName = $hash . '.' . $extension;
            $requestImage->move(public_path('img/logos'), $imageName);
            $equipment->image = $imageName;
        }
        $equipment->save();
        $equipments=Equipment::all();
        return view('pages.equipment', ['equipments'=>$equipments])->with('succes', 'Equipamento adicionado com Sucesso');

    }
    public function edit($id){


        $equipment=Equipment::findOrFail($id);

        return view('pages.equipment-edit', ['equipment'=>$equipment]);
    }


    public function list(){

        $equipments=Equipment::all();
        return view('/equipment', ['equipments'=>$equipments]);
    }



}
