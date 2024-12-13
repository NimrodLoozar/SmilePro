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
        // Conversations table
        Schema::create('conversations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('recipient');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });

        // Messages table
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('conversation_id');
            $table->unsignedBigInteger('user_id');
            $table->text('content');
            $table->boolean('is_read');
            $table->timestamps();

            $table->foreign('conversation_id')->references('id')->on('conversations')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
        DB::statement('ALTER TABLE messages MODIFY is_read BIT(1) default 0');

        // Person table
        Schema::create('person', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->string('name');
            $table->string('email');
            $table->boolean('employee')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->boolean('is_active');
            $table->text('comment')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
        });
        DB::statement('ALTER TABLE person MODIFY is_active BIT(1) default 1');

        // Rules table
        Schema::create('rules', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('user_id');
            $table->string('name')->nullable();
            $table->boolean('is_active');
            $table->text('comment')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
        });
        DB::statement('ALTER TABLE rules MODIFY is_active BIT(1) default 1');

        // Patient table
        Schema::create('patient', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('person_id');
            $table->string('number');
            $table->text('medical_file')->nullable();
            $table->boolean('is_active');
            $table->text('comment')->nullable();
            $table->timestamps();

            $table->foreign('person_id')->references('id')->on('person');
        });
        DB::statement('ALTER TABLE patient MODIFY is_active BIT(1) default 1');

        // Employee table
        Schema::create('employee', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('person_id');
            $table->string('name');
            $table->string('email');
            $table->string('number');
            $table->string('employee_type')->nullable();
            $table->string('specialization')->nullable();
            $table->text('availability')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->boolean('is_active');
            $table->text('comment')->nullable();
            $table->timestamps();

            $table->foreign('person_id')->references('id')->on('person');
            $table->foreign('user_id')->references('id')->on('users');
        });
        DB::statement('ALTER TABLE employee MODIFY is_active BIT(1) default 1');

        // Availability table
        Schema::create('availability', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('employee_id');
            $table->date('date_from');
            $table->date('date_to');
            $table->time('time_from');
            $table->time('time_to');
            $table->string('status');
            $table->boolean('is_active');
            $table->text('comment')->nullable();
            $table->timestamps();

            $table->foreign('employee_id')->references('id')->on('employee');
        });
        DB::statement('ALTER TABLE availability MODIFY is_active BIT(1) default 1');

        // Contact table
        Schema::create('contact', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('patient_id');
            $table->string('street_name');
            $table->string('house_number');
            $table->string('addition')->nullable();
            $table->string('postal_code');
            $table->string('city');
            $table->string('mobile');
            $table->string('email');
            $table->boolean('is_active');
            $table->text('comment')->nullable();
            $table->timestamps();

            $table->foreign('patient_id')->references('id')->on('patient');
        });
        DB::statement('ALTER TABLE contact MODIFY is_active BIT(1) default 1');

        // Appointment table
        Schema::create('appointment', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('patient_id');
            $table->unsignedBigInteger('employee_id');
            $table->date('date');
            $table->time('time');
            $table->string('status');
            $table->boolean('is_active');
            $table->text('comment')->nullable();
            $table->timestamps();

            $table->foreign('patient_id')->references('id')->on('patient');
            $table->foreign('employee_id')->references('id')->on('employee');
        });
        DB::statement('ALTER TABLE appointment MODIFY is_active BIT(1) default 1');

        // Treatment table
        Schema::create('treatment', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('employee_id');
            $table->unsignedBigInteger('patient_id');
            $table->date('date');
            $table->time('time');
            $table->string('treatment_type');
            $table->text('description');
            $table->decimal('cost', 8, 2);
            $table->string('status');
            $table->boolean('is_active');
            $table->text('comment')->nullable();
            $table->timestamps();

            $table->foreign('employee_id')->references('id')->on('employee');
            $table->foreign('patient_id')->references('id')->on('patient');
        });
        DB::statement('ALTER TABLE treatment MODIFY is_active BIT(1) default 1');

        // Invoice table
        Schema::create('invoice', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('patient_id');
            $table->unsignedBigInteger('treatment_id');
            $table->string('number');
            $table->date('date');
            $table->decimal('amount', 8, 2);
            $table->string('status');
            $table->boolean('is_active');
            $table->text('comment')->nullable();
            $table->timestamps();

            $table->foreign('patient_id')->references('id')->on('patient');
            $table->foreign('treatment_id')->references('id')->on('treatment');
        });
        DB::statement('ALTER TABLE invoice MODIFY is_active BIT(1) default 1');

        // Communication table
        Schema::create('communication', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('patient_id');
            $table->unsignedBigInteger('employee_id');
            $table->text('message');
            $table->date('sent_date');
            $table->boolean('is_active');
            $table->text('comment')->nullable();
            $table->timestamps();

            $table->foreign('patient_id')->references('id')->on('patient');
            $table->foreign('employee_id')->references('id')->on('employee');
        });
        DB::statement('ALTER TABLE communication MODIFY is_active BIT(1) default 1');

        // Feedback table
        Schema::create('feedback', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('patient_id');
            $table->integer('rating');
            $table->string('practice_email');
            $table->string('practice_phone');
            $table->boolean('is_active');
            $table->text('comment')->nullable();
            $table->timestamps();

            $table->foreign('patient_id')->references('id')->on('patient');
        });
        DB::statement('ALTER TABLE feedback MODIFY is_active BIT(1) default 1');

        // Schedules table
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('employee_id')->nullable();
            $table->string('name');
            $table->timestamp('start_time');
            $table->timestamp('end_time');
            $table->text('description')->nullable();
            $table->boolean('is_active');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('employee_id')->references('id')->on('employee')->onDelete('cascade');
        });
        DB::statement('ALTER TABLE schedules MODIFY is_active BIT(1) default 1');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schedules');
        Schema::dropIfExists('feedback');
        Schema::dropIfExists('communication');
        Schema::dropIfExists('invoice');
        Schema::dropIfExists('treatment');
        Schema::dropIfExists('appointment');
        Schema::dropIfExists('contact');
        Schema::dropIfExists('availability');
        Schema::dropIfExists('employee');
        Schema::dropIfExists('patient');
        Schema::dropIfExists('rules');
        Schema::dropIfExists('person');
        Schema::dropIfExists('messages');
        Schema::dropIfExists('conversations');
    }
};
