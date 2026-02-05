<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        // ১. কুয়েরি শুরু (শুধুমাত্র ইউজার টেবিল থেকে)
        $query = User::query();

        // ২. যদি রক্তের গ্রুপ সিলেক্ট করা থাকে
        if ($request->filled('blood_group')) {
            $query->where('blood_group', $request->blood_group);
        }

        // ৩. যদি জেলা সিলেক্ট করা থাকে
        if ($request->filled('district')) {
            $query->where('district', $request->district);
        }

        // ৪. যদি উপজেলা সিলেক্ট করা থাকে
        if ($request->filled('upazila')) {
            $query->where('upazila', 'like', '%' . $request->upazila . '%');
        }

        // ৫. শুধুমাত্র যারা রক্ত দিতে প্রস্তুত (ready) তাদের দেখাবো
        $donors = $query->where('availability_status', 'ready')
            ->latest()
            ->paginate(12); // প্রতি পেজে ১২ জন ডোনার

        // ৬. রেজাল্ট ভিউ ফাইলে পাঠানো (সাথে সার্চের ডাটাও ফেরত পাঠাবো)
        return view('search-results', compact('donors'));
    }
}
