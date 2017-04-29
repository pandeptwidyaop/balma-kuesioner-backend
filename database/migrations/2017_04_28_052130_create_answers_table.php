<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('answers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('question_id')->unsigned();
            $table->integer('participant_id')->unsigned();
            $table->enum('answer',['1','2','3','4']);
            $table->timestamps();
        });

        Schema::table('answers', function(Blueprint $table){
          $table->foreign('question_id')->references('id')->on('questions')->onUpdate('cascade')->onDelete('cascade');
          $table->foreign('participant_id')->references('id')->on('participants')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('answers');
    }
}
