@extends('layouts.app')

@section('title', 'LifeDrop - সার্চ রেজাল্ট')

@section('content')
<div class="container mx-auto px-4 py-10">

    <div class="text-center mb-8">
        <h2 class="text-3xl font-bold text-slate-800">
            রক্তদাতা পাওয়া গেছে: <span class="text-[#E63946]">{{ $donors->total() }} জন</span>
        </h2>
        <p class="text-slate-500 mt-2">আপনার ক্রাইটেরিয়া অনুযায়ী ফলাফল নিচে দেওয়া হলো</p>
    </div>

    @if($donors->count() > 0)
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        @foreach($donors as $donor)
        <div class="bg-white border rounded-xl shadow-sm hover:shadow-md transition p-6 text-center group">
            <div class="w-16 h-16 bg-red-50 text-[#E63946] rounded-full flex items-center justify-center text-2xl font-bold mx-auto mb-4 border border-red-100 group-hover:bg-[#E63946] group-hover:text-white transition">
                {{ $donor->blood_group }}
            </div>

            <h3 class="text-xl font-bold text-slate-800">{{ $donor->name }}</h3>
            <p class="text-slate-500 text-sm mt-1">
                <span class="font-medium">জেলা:</span> {{ $donor->district }} <br>
                <span class="font-medium">উপজেলা:</span> {{ $donor->upazila }}
            </p>

            <button class="mt-4 w-full bg-slate-900 text-white py-2 rounded-md text-sm font-medium hover:bg-[#E63946] transition">
                যোগাযোগ করুন
            </button>
        </div>
        @endforeach
    </div>

    <div class="mt-8">
        {{ $donors->withQueryString()->links() }}
    </div>
    @else
    <div class="text-center py-20 bg-slate-50 rounded-xl border border-dashed border-slate-300">
        <h3 class="text-xl text-slate-600 font-medium">দুঃখিত, কোনো রক্তদাতা পাওয়া যায়নি।</h3>
        <p class="text-slate-500 mt-2">অন্য কোনো এলাকা বা রক্তের গ্রুপ দিয়ে চেষ্টা করুন।</p>
        <a href="{{ route('home') }}" class="inline-block mt-4 text-[#E63946] font-bold hover:underline">
            &larr; আবার সার্চ করুন
        </a>
    </div>
    @endif
</div>
@endsection