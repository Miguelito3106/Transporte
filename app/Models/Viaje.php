<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Viaje extends Model
{
    use HasFactory;

    protected $fillable = [
        'vehiculo_id',
        'conductor_id',
        'ruta_id',
        'fecha',
        'km_recorridos',
        'consumo_energia',
        'ciudad',
    ];

    // Viaje pertenece a un vehículo
    public function vehiculo()
    {
        return $this->belongsTo(Vehiculo::class);
    }

    // Viaje pertenece a un conductor
    public function conductor()
    {
        return $this->belongsTo(Conductor::class);
    }

    // Viaje pertenece a una ruta
    public function ruta()
    {
        return $this->belongsTo(Ruta::class);
    }
}
