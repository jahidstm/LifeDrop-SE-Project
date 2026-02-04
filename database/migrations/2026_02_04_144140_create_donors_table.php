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
        Schema::create('donors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('blood_group');
            $table->string('district');
            $table->string('upazila');
            $table->enum('availability_status', ['ready', 'unavailable', 'cooldown'])->default('ready');
            $table->boolean('is_verified')->default(false);
            $table->boolean('hide_phone_number')->default(false);
            $table->integer('total_donations')->default(0);
            $table->integer('points')->default(0);
            $table->string('current_badge')->nullable();
            $table->timestamp('last_login_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('donors');
    }
};
