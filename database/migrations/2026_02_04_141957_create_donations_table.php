<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('donations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('donor_id')->constrained('donors')->onDelete('cascade');
            $table->foreignId('blood_request_response_id')->nullable()->constrained('blood_request_responses')->onDelete('set null');
            $table->date('donation_date');
            $table->date('next_eligible_date');
            $table->enum('status', ['pending_confirmation', 'confirmed', 'rejected'])->default('pending_confirmation');
            $table->integer('points_earned')->default(0);
            $table->date('auto_cooldown_until');
            $table->foreignId('confirmed_by')->nullable()->constrained('users');
            $table->timestamp('confirmation_date')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->index('donor_id');
            $table->index('status');
            $table->index('donation_date');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('donations');
    }
};
