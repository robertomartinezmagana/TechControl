<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificacionTable extends Migration
{
    public function up()
    {
        Schema::create('notificaciones', function (Blueprint $table) {
            $table->id('id_notificacion');
            $table->string('titulo');
            $table->text('mensaje');
            $table->enum('tipo', ['Mantenimiento', 'Incidencia', 'Vencimiento', 'General']);
            $table->timestamp('fecha_envio');
            $table->boolean('leida')->default(false);
            $table->foreignId('id_usuario_destino')->constrained('usuarios')->onDelete('cascade');
            $table->foreignId('id_mantenimiento')->nullable()->constrained('mantenimientos')->onDelete('cascade');
            $table->foreignId('id_incidencia')->nullable()->constrained('incidencias')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('notificaciones');
    }
}
