<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('privacy_settings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('donor_id')->unique()->constrained('donors')->onDelete('cascade');
            $table->boolean('hide_phone_number')->default(false);
            $table->boolean('hide_location')->default(false);
            $table->boolean('allow_anonymous_requests')->default(false);
            $table->boolean('show_in_leaderboard')->default(true);
            $table->timestamp('updated_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('privacy_settings');
    }
};
