<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('avions', function (Blueprint $table) {
            $table->id();
            $table->decimal('prix', 10, 2); // Prix de l'avion
            $table->string('description'); // Description de l'avion
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('avions');
    }
};
