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

    public function editt($id){

        $equipments=Equipment::all();
        $equipment=Equipment::findOrFail($id);

        return view('pages.equipment-edit', ['equipments'=>$equipments])->with(compact('equipment'));
    }

    public function edit(Request $request, $id)
{
    // Use $request to get the 'id' parameter from the query parameters
    $equipmentId = $request->query('id');

    // Assuming you have a variable named $equipmentId to store the retrieved id
    $equipment = Equipment::findOrFail($equipmentId);
    $equipment1 = Equipment::findOrFail($id);

    // You might want to remove the line below unless you have a specific reason for fetching all equipments
    // $equipments = Equipment::all();
    dd($equipment);

    return view('pages.equipment-edit',compact('equipment','equipment1'));
}


    public function list(){

        $equipments=Equipment::all();
        return view('/equipment', ['equipments'=>$equipments]);
    }



}
