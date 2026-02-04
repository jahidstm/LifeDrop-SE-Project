<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
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
        // ১. ভ্যালিডেশন (division বাদ দেওয়া হয়েছে)
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],

            // কাস্টম ফিল্ড
            'phone' => ['required', 'string', 'max:15'], // unique বাদ দিয়েছি আপাতত টেস্টিংয়ের সুবিধার্থে
            'blood_group' => ['required', 'string'],
            'district' => ['required', 'string', 'max:100'],
            'upazila' => ['required', 'string', 'max:100'],
        ]);

        // ২. ইউজার তৈরি (সব ডাটা users টেবিলেই যাবে)
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),

            // ডোনার ডিটেইলস (User টেবিলে)
            'phone' => $request->phone,
            'blood_group' => $request->blood_group,
            'district' => $request->district,
            'upazila' => $request->upazila,
            'is_available' => true, // ডিফল্টভাবে ডোনার রেডি
            'role' => 'donor',
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}
