<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMedecinsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::enableForeignKeyConstraints();
        Schema::create('medecins', function (Blueprint $table) {
            $table->increments('id');
            $table->string('cin',8);
            $table->string('nom');
            $table->string('prenom');
            
            $table->integer('specialite_id')->unsigned();
            // $table->foreign('specialite_id')->references('id')->on('specialites');

            $table->string('telephone');
            $table->string('email');
            $table->string('adresse');        
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
        Schema::dropIfExists('medecins');
    }
}
