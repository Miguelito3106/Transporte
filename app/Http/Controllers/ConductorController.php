<?php

namespace App\Http\Controllers;

use App\Models\Conductor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ConductorController extends Controller
{
    public function index()
    {
        $conductores = Conductor:: all();
        return response()-> json($conductores);
    }

    public function store(Request $request)
    {
        $validator = validator:: make($request->all(),[
            'nombre' => 'required|string',
            'cedula' => 'required|numeric',
            'telefono' => 'required|numeric',
            'licencia' => 'required|string',
            'años_experiencia' => 'required|numeric',
        ]);
        if ($validator -> fails()){
            return response()->json($validator -> errors(), 422);
        }
        $conductores = Conductor::create($validator->validated());
        return response()->json($conductores, 201);
    }

    public function show($id)
    {
        $conductores = Conductor:: find($id);
        if(!$conductores){
            return response()->json(['message' => 'Conductor no encontrado'], 404);
        }
        return response()->json($conductores);
    }

    public function update(Request $request, $id)
    {
        $conductores = Conductor:: find($id);
        if(!$conductores){
            return response()->json(['message' => 'Conductor no encontrado'], 404);
        }

        $validator = Validator::make($request->all(),[
            'nombre' => 'sometimes|required|string',
            'cedula' => 'sometimes|required|numeric',
            'telefono' => 'sometimes|required|numeric',
            'licencia' => 'sometimes|required|string',
            'años_experiencia' => 'sometimes|required|numeric',
        ]);

        if ($validator -> fails()){
            return response ()->json($validator->errors(), 422);
        }

        $conductores->update($validator->validated());
        return response()->json($conductores);
    }

    public function destroy($id)
    {
        $conductores = Conductor:: find($id);
        if(!$conductores){
            return response()->json(['message' => 'Conductor no encontrado'], 404);

        }

        $conductores-> delete();
        return response()->json(['message' => 'Conductor eliminado correctamente']);
    }
}