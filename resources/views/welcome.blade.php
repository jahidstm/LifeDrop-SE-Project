@extends('layouts.app')

@section('title', 'LifeDrop - হোম')

@section('content')
<section class="py-20 bg-gradient-to-b from-red-50 to-white text-center">
    <div class="container mx-auto px-4">
        <h1 class="text-4xl md:text-6xl font-bold text-slate-900 mb-6">
            রক্ত দিন, <span class="text-[#E63946]">একটি জীবন বাঁচান</span>
        </h1>
        <p class="text-lg text-slate-600 mb-8 max-w-2xl mx-auto">
            জরুরি মুহূর্তে আপনার এলাকার ভেরিফাইড রক্তদাতা খুঁজুন। দ্রুত এবং নির্ভরযোগ্যভাবে রক্তদাতা খুঁজে পান।
        </p>

        <div class="bg-white p-6 rounded-xl shadow-lg max-w-3xl mx-auto border border-slate-200">
            <form action="{{ route('donors.search') }}" method="GET">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">

                    <select name="district" id="district" class="border p-3 rounded-md w-full text-slate-600 focus:outline-none focus:border-red-500">
                        <option value="">জেলা নির্বাচন করুন</option>
                        @foreach($districts as $district)
                        <option value="{{ $district }}">{{ $district }}</option>
                        @endforeach
                    </select>

                    <select name="upazila" id="upazila" class="border p-3 rounded-md w-full text-slate-600 focus:outline-none focus:border-red-500">
                        <option value="">উপজেলা</option>
                    </select>

                    <select name="blood_group" class="border p-3 rounded-md w-full text-slate-600 focus:outline-none focus:border-red-500">
                        <option value="">রক্তের গ্রুপ</option>
                        @foreach($bloodGroups as $bg)
                        <option value="{{ $bg }}">{{ $bg }}</option>
                        @endforeach
                    </select>

                    <button type="submit" class="bg-[#E63946] text-white py-3 rounded-md font-bold hover:bg-red-700 transition w-full">
                        রক্তদাতা খুঁজুন
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>

<section class="py-12 bg-white">
    <div class="container mx-auto px-4 grid grid-cols-1 md:grid-cols-3 gap-8 text-center">
        <div class="p-6 border rounded-lg shadow-sm">
            <h3 class="text-3xl font-bold text-[#E63946]">৫০০+</h3>
            <p class="text-slate-600 mt-2">ভেরিফাইড ডোনার</p>
        </div>
        <div class="p-6 border rounded-lg shadow-sm">
            <h3 class="text-3xl font-bold text-[#E63946]">১২০+</h3>
            <p class="text-slate-600 mt-2">সফল ডোনেশন</p>
        </div>
        <div class="p-6 border rounded-lg shadow-sm">
            <h3 class="text-3xl font-bold text-[#E63946]">৬৪</h3>
            <p class="text-slate-600 mt-2">জেলায় সেবা চালু</p>
        </div>
    </div>
</section>

<script>
    const upazilaData = {
        'ঢাকা': ['সাভার', 'ধামরাই', 'কেরানীগঞ্জ', 'দোহার', 'নবাবগঞ্জ', 'মিরপুর', 'উত্তরা', 'ধানমন্ডি'],
        'চট্টগ্রাম': ['রাউজান', 'পটিয়া', 'ফটিকছড়ি', 'হাটহাজারী', 'সীতাকুণ্ড', 'পাহাড়তলী'],
        'সিলেট': ['সিলেট সদর', 'বিয়ানীবাজার', 'গোলাপগঞ্জ', 'কোম্পানীগঞ্জ'],
        'রাজশাহী': ['রাজশাহী সদর', 'বাঘা', 'চারঘাট', 'পুঠিয়া'],
        'খুলনা': ['খুলনা সদর', 'ডুমুরিয়া', 'ফুলতলা'],
        'বরিশাল': ['বরিশাল সদর', 'বাকেরগঞ্জ', 'বাবুগঞ্জ'],
        'রংপুর': ['রংপুর সদর', 'পীরগাছা', 'কাউনিয়া'],
        'ময়মনসিংহ': ['ময়মনসিংহ সদর', 'মুক্তাগাছা', 'ভালুকা'],
        'কুমিল্লা': ['কুমিল্লা সদর', 'চৌদ্দগ্রাম', 'লাকসাম', 'দাউদকান্দি'],
        'নোয়াখালী': ['নোয়াখালী সদর', 'বেগমগঞ্জ', 'চাটখিল'],
        'ফেনী': ['ফেনী সদর', 'দাগনভূঞা', 'সোনাগাজী'],
        'বগুড়া': ['বগুড়া সদর', 'শিবগঞ্জ', 'শেরপুর'],
        'সাভার': ['সাভার সদর', 'আশুলিয়া', 'আমিনবাজার', 'হেমায়েতপুর']
    };

    document.getElementById('district').addEventListener('change', function() {
        const selectedDistrict = this.value;
        const upazilaDropdown = document.getElementById('upazila');

        // আগের অপশন ক্লিয়ার করা
        upazilaDropdown.innerHTML = '<option value="">উপজেলা</option>';

        if (selectedDistrict && upazilaData[selectedDistrict]) {
            upazilaData[selectedDistrict].forEach(upazila => {
                const option = document.createElement('option');
                option.value = upazila;
                option.textContent = upazila;
                upazilaDropdown.appendChild(option);
            });
        }
    });
</script>
@endsection