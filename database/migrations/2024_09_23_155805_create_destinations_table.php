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
        Schema::create('destinations', function (Blueprint $table) {
            $table->id();
            $table->string('nom'); // Ajout de la colonne 'nom'
            $table->text('description'); // Ajout de la colonne 'description'
            $table->string('adresse'); // Ajout de la colonne 'adresse'
            $table->decimal('latitude', 10, 8); // Ajout de la colonne 'latitude'
            $table->decimal('longitude', 11, 8); // Ajout de la colonne 'longitude'
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
        Schema::dropIfExists('destinations');
    }
};
