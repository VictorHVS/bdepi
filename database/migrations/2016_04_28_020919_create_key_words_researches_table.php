<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKeyWordsResearchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('key_word_research', function (Blueprint $table) {
            $table->integer('research_id')->unsigned();
            $table->integer('key_word_id')->unsigned();
            $table->foreign('research_id')->references('id')->on('researches');
            $table->foreign('key_word_id')->references('id')->on('key_words');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('key_word_research');
    }
}
