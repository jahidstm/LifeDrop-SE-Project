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

        <div class="bg-white p-6 rounded-xl shadow-lg max-w-4xl mx-auto border border-slate-200">
            <form action="{{ route('donors.search') }}" method="GET">
                <div class="grid grid-cols-1 md:grid-cols-5 gap-4">

                    <select name="division" id="division" class="border p-3 rounded-md w-full text-slate-600 focus:outline-none focus:border-red-500">
                        <option value="">বিভাগ নির্বাচন করুন</option>
                    </select>

                    <select name="district" id="district" class="border p-3 rounded-md w-full text-slate-600 focus:outline-none focus:border-red-500">
                        <option value="">জেলা নির্বাচন করুন</option>
                    </select>

                    <select name="upazila" id="upazila" class="border p-3 rounded-md w-full text-slate-600 focus:outline-none focus:border-red-500">
                        <option value="">উপজেলা নির্বাচন করুন</option>
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
    const divisionSelect = document.getElementById('division');
    const districtSelect = document.getElementById('district');
    const upazilaSelect = document.getElementById('upazila');

    fetch('/data/bd-locations.json')
        .then(res => res.json())
        .then(data => {
            const divisions = data.divisions || {};

            // fill divisions
            Object.keys(divisions).forEach(division => {
                const option = document.createElement('option');
                option.value = division;
                option.textContent = division;
                divisionSelect.appendChild(option);
            });

            divisionSelect.addEventListener('change', function() {
                const division = this.value;

                districtSelect.innerHTML = '<option value="">জেলা নির্বাচন করুন</option>';
                upazilaSelect.innerHTML = '<option value="">উপজেলা নির্বাচন করুন</option>';

                if (divisions[division]) {
                    Object.keys(divisions[division]).forEach(district => {
                        const option = document.createElement('option');
                        option.value = district;
                        option.textContent = district;
                        districtSelect.appendChild(option);
                    });
                }
            });

            districtSelect.addEventListener('change', function() {
                const division = divisionSelect.value;
                const district = this.value;

                upazilaSelect.innerHTML = '<option value="">উপজেলা নির্বাচন করুন</option>';

                if (divisions[division] && divisions[division][district]) {
                    divisions[division][district].forEach(upazila => {
                        const option = document.createElement('option');
                        option.value = upazila;
                        option.textContent = upazila;
                        upazilaSelect.appendChild(option);
                    });
                }
            });
        });
</script>
@endsection