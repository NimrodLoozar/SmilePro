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
            // $table->foreignId('person_id')->constrained('persons');
            // $table->string('name');
            $table->string('username')->unique();
            $table->string('password');
            $table->string('email')->unique();
            $table->boolean('is_signd_in')->default(false);
            $table->datetime('signed_in')->nullable();
            $table->datetime('signed_out')->nullable();
            $table->tinyInteger('is_active')->default(1);
            $table->text('comments')->nullable();
            $table->timestamps();
        });
        // Specify the storage engine as InnoDB
        Schema::table('users', function (Blueprint $table) {
            $table->engine = 'InnoDB';
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
