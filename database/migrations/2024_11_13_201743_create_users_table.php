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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->foreignId('person_id')->constrained('persons');
            $table->string('username')->unique();
            $table->string('password');
            $table->boolean('is_signd_in')->default(false);
            $table->datetime('signed_in')->nullable();
            $table->datetime('signed_out')->nullable();
            $table->tinyInteger('is_active')->default(1);  // Corrected: use tinyInteger() for the bit-like behavior
            $table->text('comments')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
