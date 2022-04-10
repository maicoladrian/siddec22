<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHorariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('horarios', function (Blueprint $table) {
            $table->increments('id_horario');
            // campo para almacenar la hora de entrada de la mañana
            $table->time('hora_entrada_m');
            // campo para almacenar la hora de salida de la mañana
            $table->time('hora_salida_m');
            // campo para almacenar la hora de entrada de la tarde
            $table->time('hora_entrada_t');
            // campo para almacenar la hora de salida de la tarde
            $table->time('hora_salida_t');
            // campo para almacenar la fecha del inicio del horario
            $table->date('fecha_horario');
            // condicion_horario boolean para almacenar la condición del horario
            $table->boolean('condicion_horario')->default(1);
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
        Schema::dropIfExists('horarios');
    }
}
