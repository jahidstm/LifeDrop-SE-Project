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
                <div class="grid grid-cols-1 md:grid-cols-5 gap-4 items-center">

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

                    <button type="submit" class="w-full bg-[#E63946] text-white font-bold py-3 rounded-lg hover:bg-red-700 transition shadow-md hover:shadow-lg flex justify-center items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                        খুঁজুন
                    </button>
                </div>
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