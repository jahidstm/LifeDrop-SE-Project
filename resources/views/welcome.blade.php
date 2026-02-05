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
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <select class="border p-3 rounded-md w-full text-slate-600">
                    <option>জেলা নির্বাচন করুন</option>
                </select>
                <select class="border p-3 rounded-md w-full text-slate-600">
                    <option>উপজেলা</option>
                </select>
                <select class="border p-3 rounded-md w-full text-slate-600">
                    <option>রক্তের গ্রুপ</option>
                </select>
                <button class="bg-[#E63946] text-white py-3 rounded-md font-bold hover:bg-red-700 transition">
                    রক্তদাতা খুঁজুন
                </button>
            </div>
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
@endsection