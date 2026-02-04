<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Donor;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $bloodGroups = ['A+', 'A-', 'B+', 'B-', 'O+', 'O-', 'AB+', 'AB-'];
        $districts = ['Dhaka', 'Chattogram', 'Sylhet', 'Rajshahi', 'Khulna', 'Barishal', 'Rangpur', 'Mymensingh'];

        // ১. অ্যাডমিন ইউজার তৈরি
        $admin = User::create([
            'name' => 'Admin Jahid',
            'email' => 'admin@lifedrop.com',
            'password' => Hash::make('12345678'),
            'phone' => '01700000000', // ✅ এই যে ফোন নম্বর
            'role' => 'admin',
        ]);

        // অ্যাডমিনের ডোনার প্রোফাইল
        Donor::create([
            'user_id' => $admin->id,
            'blood_group' => 'B+',
            'district' => 'Dhaka',
            'upazila' => 'Savar',
            'availability_status' => 'ready',
        ]);

        // ২. ৪৯ জন ফেক ইউজার তৈরি
        for ($i = 0; $i < 49; $i++) {

            // ইউজার তৈরি
            $user = User::create([
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'password' => Hash::make('password'),
                'phone' => '017' . $faker->numerify('########'), // ✅ মিসিং ছিল, এখন দিলাম
                'role' => 'donor',
            ]);

            // ডোনার প্রোফাইল তৈরি
            Donor::create([
                'user_id' => $user->id,
                'blood_group' => $bloodGroups[array_rand($bloodGroups)],
                'district' => $districts[array_rand($districts)],
                'upazila' => $faker->city,
                'availability_status' => $faker->randomElement(['ready', 'unavailable']),
            ]);
        }
    }
}
