<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->constrained('patients');
            $table->string('streetname');
            $table->integer('housenumber');
            $table->string('adition')->nullable();
            $table->string('postalcode');
            $table->string('place');
            $table->string('mobile');
            $table->string('email')->unique();
            $table->tinyInteger('is_active')->default(1);  // Corrected: use tinyInteger() for the bit-like behavior
            $table->text('comments')->nullable();
            $table->timestamps();
        });
        // Specify the storage engine as InnoDB
        Schema::table('contacts', function (Blueprint $table) {
            $table->engine = 'InnoDB';
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contacts');
    }
};
