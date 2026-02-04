<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('organizations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->unique()->constrained('users')->onDelete('cascade');
            $table->string('organization_name');
            $table->enum('organization_type', ['hospital', 'blood_bank', 'ngo', 'student_club', 'other']);
            $table->string('district');
            $table->string('upazila');
            $table->text('address');
            $table->string('license_number')->nullable()->unique();
            $table->boolean('is_verified')->default(false);
            $table->string('logo_url')->nullable();
            $table->string('website_url')->nullable();
            $table->integer('verified_members_count')->default(0);
            $table->text('description')->nullable();
            $table->timestamps();

            $table->index('organization_type');
            $table->index('district');
            $table->index('is_verified');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('organizations');
    }
};
