<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personales', function (Blueprint $table) {
            $table->increments('id_personal');
            $table->string('codigo_control', 15);
            // campo para almacenar la mac del equipo
            $table->string('mac_pc', 30);
            // personal_id_informacion de la tabla informaciones
            $table->integer('personal_id_informacion')->unsigned();
            // personal_id_cargo de la tabla cargos
            $table->integer('personal_id_cargo')->unsigned();
            // condicion_personal para eliminar registros por logica
            // 1=activo, 0=inactivo
            $table->boolean('condicion_personal')->default(1);
            $table->timestamps();

            // foreign key personal_id_informacion de la tabla informaciones
            $table->foreign('personal_id_informacion')
            ->references('id_informacion')->on('informaciones');
            // foreign key personal_id_cargo de la tabla cargos
            $table->foreign('personal_id_cargo')
            ->references('id_cargo')->on('cargos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('personales');
    }
}
