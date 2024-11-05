<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activites', function (Blueprint $table) {
            $table->id();
            $table->string('titre');
            $table->text('contenu');
            $table->string('image')->nullable(); // Peut être nullable si l'image n'est pas obligatoire
            $table->unsignedBigInteger('user_id');
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users');
        });
        Schema::create('activite_likes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('activite_id');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();
    
            $table->foreign('activite_id')->references('id')->on('activites')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('activite_likes');
        Schema::dropIfExists('activites');
    }
};
