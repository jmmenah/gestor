<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProyectoResponsable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proyecto_responsable', function (Blueprint $table) {
            $table->unsignedBigInteger('proyecto_id');
            $table->foreign('proyecto_id', 'fk_proyecto_responsable_proyecto')->references('id')->on('proyecto')->onDelete('restrict')->onUpdate('cascade');
            $table->unsignedBigInteger('usuario_id');
            $table->foreign('usuario_id', 'fk_usuario_responsable_proyecto')->references('id')->on('usuario')->onDelete('restrict')->onUpdate('cascade');
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
        Schema::dropIfExists('proyecto_responsable');
    }
}
