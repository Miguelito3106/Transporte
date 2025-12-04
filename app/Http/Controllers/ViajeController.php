<?php

namespace App\Http\Controllers;

use App\Models\Viaje;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ViajeController extends Controller
{
    public function index()
    {
        $viajes = Viaje::all();
        return response()->json($viajes);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'vehiculo_id'     => 'required|exists:vehiculos,id',
            'conductor_id'    => 'required|exists:conductores,id',
            'ruta_id'         => 'required|exists:rutas,id',
            'fecha'           => 'required|date',
            'km_recorridos'   => 'required|numeric|min:0',
            'consumo_energia' => 'required|numeric|min:0',
            'ciudad'          => 'required|string'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $viaje = Viaje::create($validator->validated());
        return response()->json($viaje, 201);
    }

    public function show($id)
    {
        $viaje = Viaje::find($id);

        if (!$viaje) {
            return response()->json(['message' => 'Viaje no encontrado'], 404);
        }

        return response()->json($viaje);
    }

    public function update(Request $request, $id)
    {
        $viaje = Viaje::find($id);

        if (!$viaje) {
            return response()->json(['message' => 'Viaje no encontrado'], 404);
        }

        $validator = Validator::make($request->all(), [
            'vehiculo_id'     => 'sometimes|exists:vehiculos,id',
            'conductor_id'    => 'sometimes|exists:conductores,id',
            'ruta_id'         => 'sometimes|exists:rutas,id',
            'fecha'           => 'sometimes|date',
            'km_recorridos'   => 'sometimes|numeric|min:0',
            'consumo_energia' => 'sometimes|numeric|min:0',
            'ciudad'          => 'sometimes|string'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $viaje->update($validator->validated());

        return response()->json($viaje);
    }

    public function destroy($id)
    {
        $viaje = Viaje::find($id);

        if (!$viaje) {
            return response()->json(['message' => 'Viaje no encontrado'], 404);
        }

        $viaje->delete();

        return response()->json(['message' => 'Viaje eliminado correctamente']);
    }
}
