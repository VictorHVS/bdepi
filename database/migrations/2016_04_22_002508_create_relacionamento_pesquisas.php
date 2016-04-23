<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRelacionamentoPesquisas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pesquisas', function (Blueprint $table) {
            $table->foreign('usuario_id','pesquisa_fk_usuario')->references('id')->on('usuarios');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pesquisas', function (Blueprint $table) {
            $table->dropForeign('pesquisa_fk_usuario');
        });
    }
}
