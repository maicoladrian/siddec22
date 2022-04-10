<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAsistenciasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asistencias', function (Blueprint $table) {
            $table->increments('id_asistencia');
            // campo para almacenar la fecha de la asistencia
            $table->date('fecha');
            // campo para almacenar la hora de entrada de la mañana
            $table->time('hora');
            // campo para asistencia_id_personal
            $table->integer('asistencia_id_personal')->unsigned();
            // campo para asistencia_id_horario
            $table->integer('asistencia_id_horario')->unsigned();
            // campo para motivo 
            $table->string('motivo', 250)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('asistencias');
    }
}
