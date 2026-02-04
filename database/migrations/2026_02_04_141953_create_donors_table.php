<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('donors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->unique()->constrained('users')->onDelete('cascade');
            $table->enum('blood_group', ['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-']);
            $table->string('district');
            $table->string('upazila');
            $table->date('last_donation_date')->nullable();
            $table->date('next_eligible_date')->nullable();
            $table->enum('availability_status', ['ready', 'unavailable', 'cooldown'])->default('ready');
            $table->boolean('is_verified')->default(false);
            $table->boolean('hide_phone_number')->default(false);
            $table->integer('total_donations')->default(0);
            $table->integer('points')->default(0);
            $table->string('current_badge')->nullable();
            $table->timestamp('last_login_at')->nullable();
            $table->timestamps();

            $table->index('blood_group');
            $table->index('district');
            $table->index('availability_status');
            $table->index('is_verified');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('donors');
    }
};
