<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('bn_BD'); // বাংলা ডাটার জন্য
        $englishFaker = Faker::create(); // ইংরেজি ডাটার জন্য (Email/Phone)

        $districts = ['ঢাকা', 'চট্টগ্রাম', 'সিলেট', 'রাজশাহী', 'খুলনা', 'বরিশাল', 'রংপুর', 'ময়মনসিংহ', 'কুমিল্লা', 'নোয়াখালী', 'ফেনী', 'বগুড়া', 'সাভার'];
        $upazilas = ['সাভার', 'ধামরাই', 'মিরপুর', 'উত্তরা', 'ধানমন্ডি', ' গুলশান', 'বনানী', 'সিলেট সদর', 'কুমিল্লা সদর', 'ফেনী সদর'];
        $bloodGroups = ['A+', 'A-', 'B+', 'B-', 'O+', 'O-', 'AB+', 'AB-'];

        // ১. অ্যাডমিন ইউজার
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@lifedrop.com',
            'password' => Hash::make('12345678'),
            'phone' => '01700000000',
            'blood_group' => 'AB+',
            'district' => 'ঢাকা',
            'upazila' => 'সাভার',
            'availability_status' => 'ready',
        ]);

        // ২. ৫০ জন ফেইক ডোনার
        for ($i = 0; $i < 50; $i++) {
            User::create([
                'name' => $faker->name, // নাম হবে বাংলায়
                'email' => $englishFaker->unique()->safeEmail, // ইমেইল হবে ইংরেজিতে (ফিক্সড!)
                'password' => Hash::make('password'),
                'phone' => '017' . $englishFaker->randomNumber(8, true),
                'blood_group' => $faker->randomElement($bloodGroups),
                'district' => $faker->randomElement($districts),
                'upazila' => $faker->randomElement($upazilas),
                'availability_status' => $faker->randomElement(['ready', 'unavailable']),
            ]);
        }
    }
}
