<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PesquisaChaveTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pesquisas_chaves', function (Blueprint $table) {
            $table->integer('pesquisa_id')->unsigned();
            $table->foreign('pesquisa_id')->references('id')->on('pesquisas');
            $table->integer('palavras_chave_id')->unsigned();
            $table->foreign('palavras_chave_id')->references('id')->on('palavras_chave');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('pesquisas_chaves');
    }
}
