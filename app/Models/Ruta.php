<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ruta extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'distancia',
        'ciudad',
    ];

    // Una ruta tiene muchos viajes
    public function viajes()
    {
        return $this->hasMany(Viaje::class);
    }
}
