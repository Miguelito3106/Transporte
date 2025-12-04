<?php

namespace App\Http\Controllers;

use App\Models\Vehiculo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VehiculoController extends Controller
{
    public function index()
    {
        $vehiculos = Vehiculo::all();
        return response()-> json($vehiculos);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'placa' => 'required|numeric',
            'marca' => 'required|string',
            'modelo' => 'required|string',
            'estado' => 'required|string',
        ]);

        if ($validator -> fails()){
            return response ()->json($validator->errors(), 422);
        }
        $vehiculos = Vehiculo::create($validator->validated());
        return response()->json($vehiculos, 201);
    }
    public function show($id)
    {
        $vehiculos = Vehiculo:: find($id);
        if(!$vehiculos){
            return response()->json(['message' => 'Vehículo no encontrado'], 404);
        }
        return response()->json($vehiculos);
    }

    public function update(Request $request, $id)
    {
        $vehiculos = Vehiculo:: find($id);
        if(!$vehiculos){
            return response()->json(['message' => 'Vehículo no encontrado'], 404);
        }

        $validator = Validator::make($request->all(),[
            'placa' => 'sometimes|required|numeric',
            'marca' => 'sometimes|required|string',
            'modelo' => 'sometimes|required|string',
            'estado' => 'sometimes|required|string',
        ]);

        if ($validator -> fails()){
            return response ()->json($validator->errors(), 422);
        }

        $vehiculos->update($validator->validated());
        return response()->json($vehiculos);
    }

        public function destroy($id)
        {
        $vehiculos = Vehiculo:: find($id);
        if(!$vehiculos){
            return response()->json(['message' => 'Vehículo no encontrado'], 404);
        }
        $vehiculos->delete();
        return response()->json(['message' => 'Vehículo eliminado correctamente']);;
    }
}