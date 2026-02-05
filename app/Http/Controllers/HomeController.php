<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show the application landing page.
     */
    public function index()
    {
        // ডামি ডাটা (পরে ডাটাবেস থেকে আসবে)
        $bloodGroups = ['A+', 'A-', 'B+', 'B-', 'O+', 'O-', 'AB+', 'AB-'];

        $districts = [
            'ঢাকা',
            'চট্টগ্রাম',
            'সিলেট',
            'রাজশাহী',
            'খুলনা',
            'বরিশাল',
            'রংপুর',
            'ময়মনসিংহ'
        ];

        return view('welcome', compact('bloodGroups', 'districts'));
    }
}
