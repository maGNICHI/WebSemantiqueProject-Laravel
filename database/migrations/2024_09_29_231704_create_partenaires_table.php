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
        Schema::create('partenaires', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->string('nom'); // Name of the partner
            $table->text('description')->nullable(); // Description of the partner
            $table->string('email')->unique(); // Email of the partner
            $table->string('adresse'); // Address of the partner
            $table->string('telephone'); // Phone number of the partner
            $table->enum('type', ['hebergement', 'transport', 'activite']); // Type of partner (adjust values accordingly)
            $table->timestamps(); // Timestamps (created_at and updated_at)
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('partenaires');
    }
};
