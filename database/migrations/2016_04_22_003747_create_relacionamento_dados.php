<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRelacionamentoDados extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('dados', function (Blueprint $table) {
            $table->foreign('pesquisa_id','dado_fk_pesquisa')->references('id')->on('pesquisas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('dados', function (Blueprint $table) {
            $table->dropForeign('dado_fk_pesquisa');
        });
    }
}
