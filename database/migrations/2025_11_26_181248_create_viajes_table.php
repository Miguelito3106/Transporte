<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('viajes', function (Blueprint $table) {
            $table->id();

            $table->foreignId('vehiculo_id')
                ->constrained('vehiculos')
                ->onDelete('cascade');

            $table->foreignId('conductor_id')
                ->constrained('conductores')
                ->onDelete('cascade');

            $table->foreignId('ruta_id')
                ->nullable()
                ->constrained('rutas')
                ->onDelete('set null');

            $table->date('fecha');
            $table->decimal('km_recorridos', 8, 2);
            $table->decimal('consumo_energia', 8, 2);
            $table->string('ciudad');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('viajes');
    }
};
