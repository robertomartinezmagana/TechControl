<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEquipoTable extends Migration
{
    public function up()
    {
        Schema::create('equipos', function (Blueprint $table) {
            $table->id('id_equipo');
            $table->string('marca');
            $table->string('modelo');
            $table->string('numero_serie');
            $table->string('tipo_equipo');
            $table->string('ubicacion');
            $table->enum('estado', ['Operativo', 'Mantenimiento', 'Obsoleto', 'Baja']);
            $table->timestamp('fecha_registro');
            $table->foreignId('id_empleado_asignado')->constrained('empleados')->onDelete('set null');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('equipos');
    }
}
