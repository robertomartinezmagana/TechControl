<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMantenimientoTable extends Migration
{
    public function up()
    {
        Schema::create('mantenimientos', function (Blueprint $table) {
            $table->id();
            $table->enum('tipo', ['Preventivo', 'Correctivo']);
            $table->timestamp('fecha_programada');
            $table->timestamp('fecha_realizada')->nullable();
            $table->text('descripcion');
            $table->enum('estado', ['Pendiente', 'En proceso', 'Completado', 'Cancelado']);
            $table->text('observaciones')->nullable();
            $table->foreignId('id_equipo')->constrained('equipos')->onDelete('cascade');
            $table->foreignId('id_tecnico')->constrained('tecnicos')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('mantenimientos');
    }
}
