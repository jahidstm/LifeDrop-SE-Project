<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('qr_cards', function (Blueprint $table) {
            $table->id();
            $table->foreignId('donor_id')->unique()->constrained('donors')->onDelete('cascade');
            $table->text('qr_code_string')->unique();
            $table->string('qr_image_url');
            $table->boolean('is_active')->default(true);
            $table->timestamp('expires_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('qr_cards');
    }
};
