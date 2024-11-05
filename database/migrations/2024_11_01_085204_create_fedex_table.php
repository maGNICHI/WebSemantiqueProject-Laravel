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
        Schema::create('fedex', function (Blueprint $table) {
            $table->id();
            $table->string('email')->nullable(); // Email field
            $table->string('adresse')->nullable(); // Address field
            $table->text('description')->nullable(); // Description field
            $table->string('nom')->nullable(); // Name field
            $table->string('numtelephone')->nullable(); // Phone number field
            $table->timestamps(); // Created_at and Updated_at fields
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fedex');
    }
};
