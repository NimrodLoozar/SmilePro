<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;


return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('person', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id')->nullable(false);
            $table->unsignedBigInteger('user_id')->nullable(false);
            $table->string('name')->nullable(false);
            $table->string('email')->nullable(false);
            $table->date('date_of_birth')->nullable(true);
            $table->boolean('employee')->nullable(true);
            $table->boolean('is_active')->default(1);
            $table->text('comment')->nullable(true);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('email')->references('email')->on('users');
            $table->foreign('name')->references('name')->on('users'); // Re-add this line
        });
        DB::statement('ALTER TABLE person MODIFY is_active BIT(1)default 1');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('person');
    }
};
