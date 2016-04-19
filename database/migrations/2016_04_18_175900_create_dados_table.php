<?php

use Illuminate\Support\Facades\Schema;
use Phaza\LaravelPostgis\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dados', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->dateTime('data_coleta')->nullable();
            $table->string('nome');
            $table->string('info')->nullable();
            $table->string('valor')->nullable();
            $table->point('geom')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('dados');
    }
}
