<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\VehiculoController;
use App\Http\Controllers\ConductorController;
use App\Http\Controllers\RutaController;
use App\Http\Controllers\ViajeController;
use App\Http\Controllers\MantenimientoController;
use App\Http\Controllers\ReportesController;

// ======================================================
//            AUTH – RUTAS SIN PROTECCIÓN JWT
// ======================================================
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// ======================================================
//            RUTAS PROTEGIDAS CON JWT
// ======================================================
Route::middleware('auth:api')->group(function () {

    // --------- AUTH ----------
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/me', [AuthController::class, 'me']);

    // ======================================================
    //                      VEHICULOS CRUD
    // ======================================================
    Route::post('/crearvehiculo', [VehiculoController::class, 'store']);
    Route::get('/listarvehiculo', [VehiculoController::class, 'index']);
    Route::get('/mostrarvehiculo/{id}', [VehiculoController::class, 'show']);
    Route::put('/editarvehiculo/{id}', [VehiculoController::class, 'update']);
    Route::delete('/eliminarvehiculo/{id}', [VehiculoController::class, 'destroy']);

    // ======================================================
    //                    CONDUCTORES CRUD
    // ======================================================
    Route::post('/crearconductor', [ConductorController::class, 'store']);
    Route::get('/listarconductor', [ConductorController::class, 'index']);
    Route::get('/mostrarconductor/{id}', [ConductorController::class, 'show']);
    Route::put('/editarconductor/{id}', [ConductorController::class, 'update']);
    Route::delete('/eliminarconductor/{id}', [ConductorController::class, 'destroy']);

    // ======================================================
    //                         RUTAS CRUD
    // ======================================================
    Route::post('/crearruta', [RutaController::class, 'store']);
    Route::get('/listarrutas', [RutaController::class, 'index']);
    Route::get('/mostrarruta/{id}', [RutaController::class, 'show']);
    Route::put('/editarruta/{id}', [RutaController::class, 'update']);
    Route::delete('/eliminarruta/{id}', [RutaController::class, 'destroy']);

    // ======================================================
    //                        VIAJES CRUD
    // ======================================================
    Route::post('/crearviaje', [ViajeController::class, 'store']);
    Route::get('/listarviajes', [ViajeController::class, 'index']);
    Route::get('/mostrarviaje/{id}', [ViajeController::class, 'show']);
    Route::put('/editarviaje/{id}', [ViajeController::class, 'update']);
    Route::delete('/eliminarviaje/{id}', [ViajeController::class, 'destroy']);

    // ======================================================
    //                   MANTENIMIENTOS CRUD
    // ======================================================
    Route::post('/crearmantenimiento', [MantenimientoController::class, 'store']);
    Route::get('/listarmantenimientos', [MantenimientoController::class, 'index']);
    Route::get('/mostrarmantenimiento/{id}', [MantenimientoController::class, 'show']);
    Route::put('/editarmantenimiento/{id}', [MantenimientoController::class, 'update']);
    Route::delete('/eliminarmantenimiento/{id}', [MantenimientoController::class, 'destroy']);

    // ======================================================
    //                CONSULTAS ESPECIALES / REPORTES
    // ======================================================
    Route::get('/consultas/viajes-por-ciudad/{ciudad}', [ReportesController::class, 'viajesPorCiudad']);
    Route::get('/consultas/kilometros-vehiculo/{vehiculo_id}', [ReportesController::class, 'kmPorVehiculo']);
    Route::get('/consultas/promedio-consumo-conductor/{conductor_id}', [ReportesController::class, 'consumoPromedioConductor']);
    Route::get('/consultas/conductores-sin-viajes', [ReportesController::class, 'conductoresSinViajes']);
    Route::get('/consultas/vehiculos-activos', [ReportesController::class, 'vehiculosActivos']);
    Route::get('/consultas/conductores-experiencia', [ReportesController::class, 'conductoresExperiencia']);
    Route::get('/consultas/vehiculos-sin-mantenimientos', [ReportesController::class, 'vehiculosSinMantenimientos']);
    Route::get('/consultas/viajes-ultimo-mes', [ReportesController::class, 'viajesUltimoMes']);
    Route::get('/consultas/mantenimiento-mas-costoso', [ReportesController::class, 'mantenimientoMasCostoso']);
    Route::get('/consultas/conductor-con-mas-viajes', [ReportesController::class, 'conductorMasViajes']);
});
