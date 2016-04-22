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
            $table->integer('pesquisa_id')->unsigned();
            $table->dateTime('data_coleta')->nullable();
            $table->string('nome')->nullable();
            $table->string('info')->nullable();
            $table->string('valor')->nullable();
            $table->point('geom')->nullable();
            /* Se houvesse mais tempo eu faria pra aceitar qualquer poligono, BUT... este prototipo tera apenas ponto*/
            //$table->geography("geomCollection", 4326, 2, false)->nullable(); //4326;

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
        Schema::drop('dados');
    }
}
