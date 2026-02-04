<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('blood_request_responses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('blood_request_id')->constrained('blood_requests')->onDelete('cascade');
            $table->foreignId('donor_id')->constrained('donors')->onDelete('cascade');
            $table->enum('response_status', ['pending', 'accepted', 'rejected', 'completed'])->default('pending');
            $table->timestamp('responded_at')->nullable();
            $table->timestamp('claimed_at')->nullable();
            $table->timestamp('completed_at')->nullable();
            $table->text('recipient_feedback')->nullable();
            $table->text('donor_feedback')->nullable();
            $table->integer('recipient_rating')->nullable()->comment('1-5 stars');
            $table->integer('donor_rating')->nullable()->comment('1-5 stars');
            $table->boolean('is_auto_approved')->default(false);
            $table->timestamp('auto_approved_at')->nullable();
            $table->timestamps();

            $table->unique(['blood_request_id', 'donor_id']);
            $table->index('response_status');
            $table->index('completed_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('blood_request_responses');
    }
};
