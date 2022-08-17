<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActividadUsuario extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('actividad_usuario', function (Blueprint $table) {
            $table->unsignedBigInteger('actividad_id');
            $table->foreign('actividad_id', 'fk_actividad_actividad_usuario')->references('id')->on('actividad')->onDelete('restrict')->onUpdate('cascade');
            $table->unsignedBigInteger('usuario_id');
            $table->foreign('usuario_id', 'fk_usuario_actividad_usuario')->references('id')->on('usuario')->onDelete('restrict')->onUpdate('cascade');
            $table->boolean('responsable');
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_spanish_ci';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('actividad_usuario');
    }
}
