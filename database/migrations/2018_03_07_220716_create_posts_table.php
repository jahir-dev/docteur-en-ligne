<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('titre');
            $table->text('description');
            
            $table->integer('internaute_id')->unsigned();
            $table->foreign('internaute_id')->references('id')->on('internaute');
            
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
        Schema::dropIfExists('posts');
    }
}
