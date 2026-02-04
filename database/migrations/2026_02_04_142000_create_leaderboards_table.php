<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('leaderboards', function (Blueprint $table) {
            $table->id();
            $table->foreignId('donor_id')->constrained('donors')->onDelete('cascade');
            $table->integer('rank');
            $table->integer('donation_count');
            $table->integer('total_points');
            $table->string('district')->nullable();
            $table->enum('region_type', ['national', 'district'])->default('national');
            $table->timestamp('last_updated');
            $table->timestamps();

            $table->unique(['donor_id', 'region_type']);
            $table->index('rank');
            $table->index('region_type');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('leaderboards');
    }
};
