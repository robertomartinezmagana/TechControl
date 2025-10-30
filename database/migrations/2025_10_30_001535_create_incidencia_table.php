<?php

// database/migrations/xxxx_xx_xx_create_incidencia_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIncidenciaTable extends Migration
{
    public function up()
    {
        Schema::create('incidencias', function (Blueprint $table) {
            $table->id('id_incidencia');
            $table->string('titulo');
            $table->text('descripcion');
            $table->timestamp('fecha_reporte');
            $table->enum('estado', ['Pendiente', 'En proceso', 'Resuelto']);
            $table->enum('prioridad', ['Baja', 'Media', 'Alta']);
            $table->foreignId('id_usuario_reporta')->constrained('usuarios')->onDelete('cascade');
            $table->foreignId('id_usuario_tecnico')->nullable()->constrained('tecnicos')->onDelete('set null');
            $table->foreignId('id_equipo')->constrained('equipos')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('incidencias');
    }
}
