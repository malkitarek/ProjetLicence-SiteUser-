<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostGsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_gs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('utilisateur_id');
            $table->integer('groupe_id');
            $table->string('contenu')->nullable();
            $table->string('image')->nullable();
            $table->string('file')->nullable();
            $table->string('titre')->nullable();
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
        Schema::dropIfExists('post_gs');
    }
}
