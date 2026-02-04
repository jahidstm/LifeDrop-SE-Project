<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // ডিফল্ট Test User তৈরির কোডটি মুছে দিয়েছি
        // এখন শুধু আমাদের কাস্টম UserSeeder কল হবে
        $this->call(UserSeeder::class);
    }
}
