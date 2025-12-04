<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Viaje;
use App\Models\Mantenimiento;

class Vehiculo extends Model
{
    use HasFactory;

    protected $fillable = [
        'placa',
        'marca',
        'modelo',
        'estado',
    ];

    // Un vehículo tiene muchos viajes
    public function viajes()
    {
        return $this->hasMany(Viaje::class, 'vehiculo_id');
    }

    // Un vehículo tiene muchos mantenimientos
    public function mantenimientos()
    {
        return $this->hasMany(Mantenimiento::class, 'vehiculo_id');
    }
}
