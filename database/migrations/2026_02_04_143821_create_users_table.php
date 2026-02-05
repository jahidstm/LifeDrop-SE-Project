<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone')->unique();

            $table->string('blood_group')->nullable(); // রক্তের গ্রুপ
            $table->string('district')->nullable();    // জেলা
            $table->string('upazila')->nullable();     // উপজেলা
            $table->string('availability_status')->default('unavailable'); // ready / unavailable
            // ----------------------------------------

            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');

            $table->enum('role', ['donor', 'recipient', 'organization', 'admin'])->default('donor');
            $table->enum('status', ['active', 'inactive', 'banned'])->default('active');

            $table->rememberToken();
            $table->timestamps();

            $table->index('role');
            $table->index('status');
            $table->index(['blood_group', 'district', 'availability_status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
