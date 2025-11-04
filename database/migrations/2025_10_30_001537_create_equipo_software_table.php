<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEquipoSoftwareTable extends Migration
{
    public function up()
    {
        Schema::create('equipo_software', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_equipo')->constrained('equipos')->onDelete('cascade');
            $table->foreignId('id_software')->constrained('software')->onDelete('cascade');
            $table->timestamp('fecha_instalacion');
            $table->timestamp('fecha_vencimiento');
            $table->string('version_instalada');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('equipo_software');
    }
}
