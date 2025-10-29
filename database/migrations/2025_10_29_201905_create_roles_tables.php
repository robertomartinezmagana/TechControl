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
        // Define all role tables with their corresponding primary key names
        $roles = [
            'administrador' => 'id_administrador',
            'empleado'      => 'id_empleado',
            'tecnico'       => 'id_tecnico',
        ];

        foreach ($roles as $tableName => $primaryKey) {
            Schema::create($tableName, function (Blueprint $table) use ($primaryKey) {
                $table->id($primaryKey);

                // Foreign key to users.id
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
        Schema::dropIfExists('administrador');
        Schema::dropIfExists('empleado');
        Schema::dropIfExists('tecnico');
    }
};
