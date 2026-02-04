<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('blood_requests', function (Blueprint $table) {
            $table->id();
            $table->string('request_code')->unique();
            $table->string('patient_name');
            $table->enum('required_blood_group', ['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-']);
            $table->integer('quantity')->comment('in units');
            $table->string('district');
            $table->string('upazila');
            $table->string('hospital_name');
            $table->string('phone_number');
            $table->enum('urgency_level', ['critical', 'high', 'normal'])->default('normal');
            $table->enum('status', ['open', 'fulfilled', 'cancelled'])->default('open');
            $table->decimal('latitude', 10, 8)->nullable();
            $table->decimal('longitude', 11, 8)->nullable();
            $table->text('notes')->nullable();
            $table->timestamp('expires_at');
            $table->timestamps();

            $table->index('required_blood_group');
            $table->index('district');
            $table->index('status');
            $table->index('urgency_level');
            $table->index('created_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('blood_requests');
    }
};
