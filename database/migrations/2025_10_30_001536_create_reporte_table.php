<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReporteTable extends Migration
{
    public function up()
    {
        Schema::create('reportes', function (Blueprint $table) {
            $table->id('id_reporte');
            $table->enum('tipo', ['Inventario', 'Mantenimiento', 'Incidencias', 'General']);
            $table->enum('formato', ['PDF', 'Excel']);
            $table->string('ruta_archivo');
            $table->foreignId('id_admin')->constrained('administradores')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('reportes');
    }
}
