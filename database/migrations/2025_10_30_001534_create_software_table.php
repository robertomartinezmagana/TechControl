<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSoftwareTable extends Migration
{
    public function up()
    {
        Schema::create('software', function (Blueprint $table) {
            $table->id('id_software');
            $table->string('nombre');
            $table->string('version');
            $table->string('licencia');
            $table->string('fabricante');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('software');
    }
}
