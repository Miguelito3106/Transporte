<?php

namespace App\Http\Controllers;

use App\Models\Mantenimiento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MantenimientoController extends Controller
{
    public function index()
    {
        $mantenimientos = Mantenimiento::all();
        return response()->json($mantenimientos);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'vehiculo_id' => 'required|exists:vehiculos,id',
            'fecha'       => 'required|date',
            'tipo'        => 'required|string',
            'descripcion' => 'required|string',
            'costo'       => 'required|numeric|min:0'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $mantenimiento = Mantenimiento::create($validator->validated());
        return response()->json($mantenimiento, 201);
    }

    public function show($id)
    {
        $mantenimiento = Mantenimiento::find($id);

        if (!$mantenimiento) {
            return response()->json(['message' => 'Mantenimiento no encontrado'], 404);
        }

        return response()->json($mantenimiento);
    }

    public function update(Request $request, $id)
    {
        $mantenimiento = Mantenimiento::find($id);

        if (!$mantenimiento) {
            return response()->json(['message' => 'Mantenimiento no encontrado'], 404);
        }

        $validator = Validator::make($request->all(), [
            'vehiculo_id' => 'sometimes|exists:vehiculos,id',
            'fecha'       => 'sometimes|date',
            'tipo'        => 'sometimes|string',
            'descripcion' => 'sometimes|string',
            'costo'       => 'sometimes|numeric|min:0'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $mantenimiento->update($validator->validated());

        return response()->json($mantenimiento);
    }

    public function destroy($id)
    {
        $mantenimiento = Mantenimiento::find($id);

        if (!$mantenimiento) {
            return response()->json(['message' => 'Mantenimiento no encontrado'], 404);
        }

        $mantenimiento->delete();

        return response()->json(['message' => 'Mantenimiento eliminado correctamente']);
    }
}
