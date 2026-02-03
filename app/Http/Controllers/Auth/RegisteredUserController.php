<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\DonorProfile; // ডোনার প্রোফাইল মডেল ইম্পোর্ট করা হলো (জরুরি!)
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // ১. সব ইনপুট ভ্যালিডেশন (Validation)
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],

            // আমাদের কাস্টম ফিল্ডগুলো (রক্তের গ্রুপ, ফোন, ঠিকানা)
            'phone' => ['required', 'string', 'max:15', 'unique:' . User::class],
            'blood_group' => ['required', 'string', 'in:A+,A-,B+,B-,AB+,AB-,O+,O-'],
            'division' => ['required', 'string', 'max:100'],
            'district' => ['required', 'string', 'max:100'],
            'upazila' => ['required', 'string', 'max:100'],
        ]);

        // ২. মেইন ইউজার একাউন্ট তৈরি (User Table)
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone, // ফোন নম্বর অ্যাড করা হলো
            'role' => 'donor', // ডিফল্ট রোল 'donor' সেট করে দিলাম
        ]);

        // ৩. সাথে সাথেই ডোনার প্রোফাইল তৈরি (DonorProfile Table)
        DonorProfile::create([
            'user_id' => $user->id,
            'blood_group' => $request->blood_group,
            'division' => $request->division,
            'district' => $request->district,
            'upazila' => $request->upazila,
            'is_available' => true, // শুরুতে সবাই রক্ত দিতে পারবে
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}
