<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('badges', function (Blueprint $table) {
            $table->id();
            $table->string('badge_name')->unique();
            $table->text('badge_description');
            $table->string('badge_icon')->comment('emoji or icon path');
            $table->integer('required_points');
            $table->enum('badge_type', ['milestone', 'campus_hero', 'special', 'achievement'])->default('achievement');
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->index('badge_type');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('badges');
    }
};
