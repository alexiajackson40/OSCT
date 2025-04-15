<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScheduleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedule', function (Blueprint $table) {
            $table->id();
            $table->string('NIVEL')->nullable();
            $table->string('TURNO')->nullable();
            $table->string('CCT')->nullable();
            $table->string('NOMBRE DE LA ESCUELA')->nullable();
            $table->string('MUNICIPIO')->nullable();
            $table->string('LOCALIDAD')->nullable();
            $table->string('DOMICILIO')->nullable();
            $table->integer('TOTAL DE ALUMNOS')->nullable();
            $table->date('FECHA')->nullable();
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
        Schema::dropIfExists('schedules');
    }
}