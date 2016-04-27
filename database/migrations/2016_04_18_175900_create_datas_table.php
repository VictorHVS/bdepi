<?php

use Illuminate\Support\Facades\Schema;
use Phaza\LaravelPostgis\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDatasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('datas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('info')->nullable();
            $table->string('value');
            $table->point('geom')->nullable();
            /* Se houvesse mais tempo eu faria pra aceitar qualquer poligono, BUT... este prototipo tera apenas ponto*/
            $table->integer('research_id')->unsigned();
            $table->dateTime('data_attain')->nullable();
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
        Schema::drop('datas');
    }
}
