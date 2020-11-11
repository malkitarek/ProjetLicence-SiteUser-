<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUtilisateursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('utilisateurs', function (Blueprint $table) {

            $table->increments('id');
            $table->integer('utilisateurable_id');
            $table->string('utilisateurable_type');
            $table->string('nom');
            $table->string('prenom');
            $table->string('email')->unique();
            $table->enum('sexe', ['homme', 'femme'])->nullable();
            $table->string('lieu_n')->nullable();
            $table->date('date_n')->nullable();
            $table->string('photo');
            $table->rememberToken();

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
        Schema::dropIfExists('utilisateurs');
    }
}
