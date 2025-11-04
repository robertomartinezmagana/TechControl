<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $roles = [
            'administradores' => 'id_administrador',
            'empleados'        => 'id_empleado',
            'tecnicos'         => 'id_tecnico',
        ];

        foreach ($roles as $tableName => $primaryKey) {
            Schema::create($tableName, function (Blueprint $table) use ($primaryKey) {
                $table->id($primaryKey);
                $table->unsignedBigInteger('id_usuario');
                $table->foreign('id_usuario')
                      ->references('id')
                      ->on('users')
                      ->onDelete('cascade');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('administradores');
        Schema::dropIfExists('empleados');
        Schema::dropIfExists('tecnicos');
    }
};
