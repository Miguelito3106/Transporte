<?php

namespace App\Http\Controllers;

use App\Models\Viaje;
use App\Models\Vehiculo;
use App\Models\Conductor;
use App\Models\Mantenimiento;
use Illuminate\Http\Request;

class ReportesController extends Controller
{
    // 1. Viajes por ciudad
    public function viajesPorCiudad($ciudad)
    {
        return Viaje::where('ciudad', $ciudad)->get();
    }

    // 2. Total km por vehículo
    public function kmPorVehiculo($vehiculo_id)
    {
        return [
            'total_km' => Viaje::where('vehiculo_id', $vehiculo_id)->sum('km_recorridos')
        ];
    }

    // 3. Promedio de consumo por conductor
    public function consumoPromedioConductor($conductor_id)
    {
        return [
            'promedio_consumo' => Viaje::where('conductor_id', $conductor_id)->avg('consumo_energia')
        ];
    }

    // 4. Conductores sin viajes
    public function conductoresSinViajes()
    {
        return Conductor::doesntHave('viajes')->get();
    }

    // 5. Vehículos activos
    public function vehiculosActivos()
    {
        return Vehiculo::where('estado', 'activo')->get();
    }

    // 6. Conductores con +3 años y con viajes
    public function conductoresExperiencia()
    {
        return Conductor::where('años_experiencia', '>', 3)
            ->has('viajes')
            ->get();
    }

    // 7. Vehículos sin mantenimiento
    public function vehiculosSinMantenimientos()
    {
        return Vehiculo::doesntHave('mantenimientos')->get();
    }

    // 8. Viajes del último mes
public function viajesUltimoMes()
{
    return Viaje::where('fecha', '>=', now()->subMonth()->toDateString())
        ->where('fecha', '<=', now()->toDateString())
        ->with(['conductor', 'vehiculo'])
        ->orderBy('fecha', 'desc')
        ->get();
}



    // 9. Vehículo con mantenimiento más caro
    public function mantenimientoMasCostoso()
    {
        $m = Mantenimiento::orderBy('costo', 'desc')->first();
        return [
            'mantenimiento' => $m,
            'vehiculo' => $m->vehiculo ?? null
        ];
    }

    // 10. Conductor con más viajes
    public function conductorMasViajes()
    {
        return Conductor::withCount('viajes')
            ->orderBy('viajes_count', 'desc')
            ->first();
    }
}
