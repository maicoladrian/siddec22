<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInformacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('informaciones', function (Blueprint $table) {
            $table->increments('id_informacion');
            $table->string('ap_paterno', 40)->nullable();
            $table->string('ap_materno', 40)->nullable();
            $table->string('nombres', 60);
            $table->string('ci', 10)->nullable();
            $table->string('celular', 10)->nullable();
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
        Schema::dropIfExists('informaciones');
    }
}
