<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIncidenciaUsuario extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('incidencia_usuario', function (Blueprint $table) {
            $table->unsignedBigInteger('incidencia_id');
            $table->foreign('incidencia_id', 'fk_incidencia_incidencia_usuario')->references('id')->on('incidencia')->onDelete('restrict')->onUpdate('cascade');
            $table->unsignedBigInteger('usuario_id');
            $table->foreign('usuario_id', 'fk_usuario_incidencia_usuario')->references('id')->on('usuario')->onDelete('restrict')->onUpdate('cascade');
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
        Schema::dropIfExists('incidencia_usuario');
    }
}
