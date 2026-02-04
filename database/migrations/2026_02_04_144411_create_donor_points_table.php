<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('donor_points', function (Blueprint $table) {
            $table->id();
            $table->foreignId('donor_id')->unique()->constrained('donors')->onDelete('cascade');
            $table->integer('total_points')->default(0);
            $table->integer('current_level')->default(1);
            $table->text('points_breakdown')->nullable()->comment('JSON: donation:100, review:5, referral:50');
            $table->timestamp('last_updated');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('donor_points');
    }
};
