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
        Schema::create('blood_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            $table->string('patient_name');
            $table->enum('blood_group', ['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-']);
            $table->integer('bags_needed')->default(1);
            $table->string('contact_phone');

            $table->string('hospital_name');
            $table->string('district');
            $table->string('upazila');
            $table->dateTime('needed_date');

            $table->string('document_image')->nullable();
            $table->enum('urgency', ['standard', 'urgent'])->default('standard');
            $table->boolean('is_verified')->default(false);

            $table->enum('status', ['active', 'managed', 'closed'])->default('active');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blood_requests');
    }
};
