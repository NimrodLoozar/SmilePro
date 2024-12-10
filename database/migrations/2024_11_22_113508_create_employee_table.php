<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('employee', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->unsignedBigInteger('person_id');
            $table->unsignedBigInteger('user_id');
            $table->string('name');
            $table->bigInteger('number')->unique();
            $table->string('email');
            $table->string('employee_type')->nullable();
            $table->string('specialization')->nullable();
            $table->text('availability')->nullable();
            $table->boolean('employee')->default(0);
            $table->date('date_of_birth')->nullable();
            $table->boolean('is_active')->default(1);
            $table->text('comment')->nullable();
            $table->timestamps();

            $table->foreign('person_id')->references('id')->on('person');
            // yo
        });
        DB::statement('ALTER TABLE employee MODIFY is_active BIT(1)default 1');

        // Create trigger to copy data from users table to employee table
        // DB::unprepared('
        //     CREATE TRIGGER copy_user_to_employee AFTER INSERT ON users
        //     FOR EACH ROW
        //     BEGIN
        //         IF employee = 1 THEN
        //             INSERT INTO employee (id, person_id, number, employee_type, specialization, availability, employee, is_active, comment, created_at, updated_at)
        //             VALUES (id, id, number, employee_type, specialization, availability, employee, is_active, comment, NOW(), NOW());
        //         END IF;
        //     END
        // ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop the trigger before dropping the table
        DB::unprepared('DROP TRIGGER IF EXISTS copy_user_to_employee');
        Schema::dropIfExists('employee');
    }
};
