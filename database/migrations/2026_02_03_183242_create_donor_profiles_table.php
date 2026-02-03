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
        Schema::create('donor_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); 

            $table->enum('blood_group', ['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-']);
            $table->string('division');
            $table->string('district');
            $table->string('upazila');
            $table->string('union')->nullable();

            $table->date('last_donation_date')->nullable();
            $table->boolean('is_available')->default(true);

            $table->integer('total_donations')->default(0); 
            $table->integer('points')->default(0); 
            $table->string('current_badge')->default('Rookie'); 

            $table->enum('privacy_mode', ['public', 'private'])->default('public');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('donor_profiles');
    }
};
