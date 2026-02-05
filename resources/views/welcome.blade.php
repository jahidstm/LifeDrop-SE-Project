@extends('layouts.app')

@section('title', 'LifeDrop - হোম')

@section('content')

<section class="py-20 bg-gradient-to-b from-red-50 to-white text-center">
    <div class="container mx-auto px-4">
        <h1 class="text-4xl md:text-6xl font-bold text-slate-900 mb-6">
            রক্ত দিন, <span class="text-[#E63946]">একটি জীবন বাঁচান</span>
        </h1>
        <p class="text-lg text-slate-600 mb-10 max-w-2xl mx-auto">
            জরুরি মুহূর্তে আপনার এলাকার ভেরিফাইড রক্তদাতা খুঁজুন। দ্রুত এবং নির্ভরযোগ্যভাবে রক্তদাতা খুঁজে পান।
        </p>

        <div class="bg-white p-4 rounded-2xl shadow-lg max-w-6xl mx-auto border border-slate-100">
            <form action="{{ route('donors.list') }}" method="GET">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <div class="relative">
                        <select name="division" id="division" class="w-full p-3 border border-slate-300 rounded-lg focus:outline-none focus:border-[#E63946] bg-white text-slate-700">
                            <option value="">বিভাগ নির্বাচন</option>
                        </select>
                    </div>

                    <div class="relative">
                        <select name="district" id="district" class="w-full p-3 border border-slate-300 rounded-lg focus:outline-none focus:border-[#E63946] bg-white text-slate-700 disabled:bg-slate-100" disabled>
                            <option value="">জেলা নির্বাচন</option>
                        </select>
                    </div>

                    <div class="relative">
                        <select name="upazila" id="upazila" class="w-full p-3 border border-slate-300 rounded-lg focus:outline-none focus:border-[#E63946] bg-white text-slate-700 disabled:bg-slate-100" disabled>
                            <option value="">উপজেলা/এরিয়া</option>
                        </select>
                    </div>

                    <div class="relative">
                        <select name="blood_group" class="w-full p-3 border border-slate-300 rounded-lg focus:outline-none focus:border-[#E63946] bg-white text-slate-700">
                            <option value="">রক্তের গ্রুপ</option>
                            <option value="A+">A+</option>
                            <option value="A-">A-</option>
                            <option value="B+">B+</option>
                            <option value="B-">B-</option>
                            <option value="AB+">AB+</option>
                            <option value="AB-">AB-</option>
                            <option value="O+">O+</option>
                            <option value="O-">O-</option>
                        </select>
                    </div>
                </div>

                <button type="submit" class="mt-4 w-full bg-[#E63946] text-white font-bold py-3 rounded-lg hover:bg-red-700 transition shadow-md hover:shadow-lg flex justify-center items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                    খুঁজুন
                </button>
            </form>
        </div>
    </div>
</section>

<section class="py-12 bg-white border-t border-slate-100">
    <div class="container mx-auto px-4 grid grid-cols-1 md:grid-cols-3 gap-8 text-center">
        <div class="p-6 border border-slate-100 rounded-xl shadow-sm hover:shadow-md transition bg-slate-50">
            <h3 class="text-4xl font-bold text-[#E63946]">৫০০+</h3>
            <p class="text-slate-600 font-medium mt-2">ভেরিফাইড ডোনার</p>
        </div>
        <div class="p-6 border border-slate-100 rounded-xl shadow-sm hover:shadow-md transition bg-slate-50">
            <h3 class="text-4xl font-bold text-[#E63946]">১২০+</h3>
            <p class="text-slate-600 font-medium mt-2">সফল ডোনেশন</p>
        </div>
        <div class="p-6 border border-slate-100 rounded-xl shadow-sm hover:shadow-md transition bg-slate-50">
            <h3 class="text-4xl font-bold text-[#E63946]">৬৪</h3>
            <p class="text-slate-600 font-medium mt-2">জেলায় সেবা চালু</p>
        </div>
    </div>
</section>

<section class="py-20 bg-slate-50">
    <div class="container mx-auto px-4">

        <div class="text-center mb-12">
            <span class="inline-block bg-red-100 text-[#E63946] text-xs font-bold px-3 py-1 rounded-full mb-3 shadow-sm">
                জরুরি
            </span>
            <h2 class="text-3xl md:text-4xl font-bold text-slate-800">
                জরুরি <span class="text-[#E63946]">রক্তের প্রয়োজন</span>
            </h2>
            <p class="text-slate-500 mt-2 text-lg">এই রোগীদের এখনই আপনার সাহায্য প্রয়োজন</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 max-w-6xl mx-auto">

            <div class="bg-white rounded-2xl p-6 border border-slate-100 shadow-sm hover:shadow-xl transition duration-300 group">
                <div class="flex justify-between items-start mb-6">
                    <div>
                        <h3 class="text-xl font-bold text-slate-800 group-hover:text-[#E63946] transition">রহিম উদ্দিন</h3>
                        <p class="text-sm text-slate-500 mt-1 font-medium">ঢাকা মেডিকেল কলেজ হাসপাতাল</p>
                    </div>
                    <div class="w-12 h-12 rounded-full bg-gradient-to-br from-[#E63946] to-red-600 text-white flex items-center justify-center font-bold text-lg shadow-lg shadow-red-200">
                        B+
                    </div>
                </div>

                <div class="space-y-3 text-sm text-slate-600 mb-8">
                    <div class="flex items-center gap-3 bg-slate-50 p-2 rounded-lg">
                        <svg class="w-5 h-5 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        <span class="font-medium">সাভার, ঢাকা</span>
                    </div>
                    <div class="flex items-center gap-3 bg-slate-50 p-2 rounded-lg">
                        <svg class="w-5 h-5 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span class="font-medium">২ ঘণ্টা আগে পোস্ট করা হয়েছে</span>
                    </div>
                </div>

                <button class="w-full bg-[#E63946] text-white font-bold py-3 rounded-xl hover:bg-red-700 transition flex items-center justify-center gap-2 shadow-md hover:shadow-lg shadow-red-200">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                    </svg>
                    কল করুন
                </button>
            </div>

            <div class="bg-white rounded-2xl p-6 border border-slate-100 shadow-sm hover:shadow-xl transition duration-300 group">
                <div class="flex justify-between items-start mb-6">
                    <div>
                        <h3 class="text-xl font-bold text-slate-800 group-hover:text-[#E63946] transition">ফাতিমা বেগম</h3>
                        <p class="text-sm text-slate-500 mt-1 font-medium">ইবনে সিনা হাসপাতাল</p>
                    </div>
                    <div class="w-12 h-12 rounded-full bg-gradient-to-br from-[#E63946] to-red-600 text-white flex items-center justify-center font-bold text-lg shadow-lg shadow-red-200">
                        O-
                    </div>
                </div>

                <div class="space-y-3 text-sm text-slate-600 mb-8">
                    <div class="flex items-center gap-3 bg-slate-50 p-2 rounded-lg">
                        <svg class="w-5 h-5 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        <span class="font-medium">গুলশান, ঢাকা</span>
                    </div>
                    <div class="flex items-center gap-3 bg-slate-50 p-2 rounded-lg">
                        <svg class="w-5 h-5 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span class="font-medium">৪ ঘণ্টা আগে পোস্ট করা হয়েছে</span>
                    </div>
                </div>

                <button class="w-full bg-[#E63946] text-white font-bold py-3 rounded-xl hover:bg-red-700 transition flex items-center justify-center gap-2 shadow-md hover:shadow-lg shadow-red-200">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                    </svg>
                    কল করুন
                </button>
            </div>

            <div class="bg-white rounded-2xl p-6 border border-slate-100 shadow-sm hover:shadow-xl transition duration-300 group">
                <div class="flex justify-between items-start mb-6">
                    <div>
                        <h3 class="text-xl font-bold text-slate-800 group-hover:text-[#E63946] transition">করিম মিয়্যা</h3>
                        <p class="text-sm text-slate-500 mt-1 font-medium">চট্টগ্রাম মেডিকেল কলেজ</p>
                    </div>
                    <div class="w-12 h-12 rounded-full bg-gradient-to-br from-[#E63946] to-red-600 text-white flex items-center justify-center font-bold text-lg shadow-lg shadow-red-200">
                        AB+
                    </div>
                </div>

                <div class="space-y-3 text-sm text-slate-600 mb-8">
                    <div class="flex items-center gap-3 bg-slate-50 p-2 rounded-lg">
                        <svg class="w-5 h-5 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        <span class="font-medium">হালিশহর, চট্টগ্রাম</span>
                    </div>
                    <div class="flex items-center gap-3 bg-slate-50 p-2 rounded-lg">
                        <svg class="w-5 h-5 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span class="font-medium">৫ ঘণ্টা আগে পোস্ট করা হয়েছে</span>
                    </div>
                </div>

                <button class="w-full bg-[#E63946] text-white font-bold py-3 rounded-xl hover:bg-red-700 transition flex items-center justify-center gap-2 shadow-md hover:shadow-lg shadow-red-200">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                    </svg>
                    কল করুন
                </button>
            </div>

        </div>

        <div class="text-center mt-12">
            <a href="#" class="inline-block bg-white border border-slate-300 text-slate-700 font-bold px-8 py-3 rounded-lg hover:bg-[#E63946] hover:text-white hover:border-[#E63946] transition duration-300 shadow-sm">
                সব দেখুন
            </a>
        </div>
    </div>
</section>

<script>
    const divisionSelect = document.getElementById('division');
    const districtSelect = document.getElementById('district');
    const upazilaSelect = document.getElementById('upazila');

    // JSON ফাইল লোড করা
    fetch('/data/bd-locations.json')
        .then(res => res.json())
        .then(data => {
            // JSON স্ট্রাকচার অনুযায়ী ডাটা ধরা (data.divisions যদি থাকে)
            const divisions = data.divisions || data;

            // বিভাগ লোড করা
            Object.keys(divisions).sort().forEach(division => {
                const option = document.createElement('option');
                option.value = division;
                option.textContent = division;
                divisionSelect.appendChild(option);
            });

            // বিভাগ পরিবর্তন হলে জেলা লোড
            divisionSelect.addEventListener('change', function() {
                const division = this.value;
                districtSelect.innerHTML = '<option value="">জেলা নির্বাচন</option>';
                upazilaSelect.innerHTML = '<option value="">উপজেলা/এরিয়া</option>';
                districtSelect.disabled = true;
                upazilaSelect.disabled = true;

                if (division && divisions[division]) {
                    districtSelect.disabled = false;
                    Object.keys(divisions[division]).sort().forEach(district => {
                        const option = document.createElement('option');
                        option.value = district;
                        option.textContent = district;
                        districtSelect.appendChild(option);
                    });
                }
            });

            // জেলা পরিবর্তন হলে উপজেলা লোড
            districtSelect.addEventListener('change', function() {
                const division = divisionSelect.value;
                const district = this.value;
                upazilaSelect.innerHTML = '<option value="">উপজেলা/এরিয়া</option>';
                upazilaSelect.disabled = true;

                if (division && district && divisions[division][district]) {
                    upazilaSelect.disabled = false;
                    divisions[division][district].sort().forEach(upazila => {
                        const option = document.createElement('option');
                        option.value = upazila;
                        option.textContent = upazila;
                        upazilaSelect.appendChild(option);
                    });
                }
            });
        })
        .catch(error => console.error('Error loading locations:', error));
</script>

@endsection