<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('donor_badges', function (Blueprint $table) {
            $table->id();
            $table->foreignId('donor_id')->constrained('donors')->onDelete('cascade');
            $table->foreignId('badge_id')->constrained('badges')->onDelete('cascade');
            $table->timestamp('unlocked_at');
            $table->timestamps();

            $table->unique(['donor_id', 'badge_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('donor_badges');
    }
};
