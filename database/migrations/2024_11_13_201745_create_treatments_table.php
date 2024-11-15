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
        Schema::create('treatments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained('employees');
            $table->date('date');
            $table->time('time');
            $table->text('description');
            $table->decimal('costs', 10, 2);
            $table->enum('status', ['Behandeld', 'Onbehandeld', 'Uitgesteld']);
            $table->tinyInteger('is_active')->default(1);  // Corrected: use tinyInteger() for the bit-like behavior
            $table->text('comments')->nullable();
            $table->timestamps();
        });
        // Specify the storage engine as InnoDB
        Schema::table('treatments', function (Blueprint $table) {
            $table->engine = 'InnoDB';
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('treatments');
    }
};
