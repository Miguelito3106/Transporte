<?php

namespace App\Http\Controllers;

use App\Models\Ruta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RutaController extends Controller
{
    public function index()
    {
        $rutas = Ruta::all();
        return response()->json($rutas);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre'   => 'required|string',
            'distancia'=> 'required|numeric',
            'ciudad'   => 'required|string'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $ruta = Ruta::create($validator->validated());
        return response()->json($ruta, 201);
    }

    public function show($id)
    {
        $ruta = Ruta::find($id);

        if (!$ruta) {
            return response()->json(['message' => 'Ruta no encontrada'], 404);
        }

        return response()->json($ruta);
    }

    public function update(Request $request, $id)
    {
        $ruta = Ruta::find($id);

        if (!$ruta) {
            return response()->json(['message' => 'Ruta no encontrada'], 404);
        }

        $validator = Validator::make($request->all(), [
            'nombre'    => 'sometimes|required|string',
            'distancia' => 'sometimes|required|numeric',
            'ciudad'    => 'sometimes|required|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $ruta->update($validator->validated());

        return response()->json($ruta);
    }

    public function destroy($id)
    {
        $ruta = Ruta::find($id);

        if (!$ruta) {
            return response()->json(['message' => 'Ruta no encontrada'], 404);
        }

        $ruta->delete();

        return response()->json(['message' => 'Ruta eliminada correctamente']);
    }
}
