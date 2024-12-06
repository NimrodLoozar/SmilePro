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
        // Verwijder de rules migratie
        // Schema::create('rules', function (Blueprint $table) {
        //     $table->engine = 'InnoDB';
        //     $table->increments('id');
        //     $table->unsignedBigInteger('user_id');
        //     $table->string('name')->nullable();
        //     $table->boolean('is_active');
        //     $table->text('comment')->nullable();
        //     $table->timestamps();

        //     $table->foreign('user_id')->references('id')->on('users');
        // });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Schema::dropIfExists('rules');
    }
};
