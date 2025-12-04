<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conductor extends Model
{
    use HasFactory;
    protected $table = 'conductores';


    protected $fillable = [
        'nombre',
        'cedula',
        'telefono',
        'licencia',
        'años_experiencia',
    ];

    // Un conductor tiene muchos viajes
    public function viajes()
    {
        return $this->hasMany(Viaje::class);
    }
}
