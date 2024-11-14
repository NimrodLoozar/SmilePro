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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->constrained('patients');
            $table->foreignId('treatment_id')->constrained('treatments');
            $table->integer('nummber')->unique();
            $table->date('date');
            $table->decimal('amount', 10, 2);
            $table->enum('status', ['Verzonden', 'Niet-Verzonden', 'Betaald', 'Onbetaald']);
            $table->tinyInteger('is_active')->default(1);  // Corrected: use tinyInteger() for the bit-like behavior
            $table->text('comments')->nullable();
            $table->timestamps();
        });
        // Specify the storage engine as InnoDB
        Schema::table('invoice', function (Blueprint $table) {
            $table->engine = 'InnoDB';
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
