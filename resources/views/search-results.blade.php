@extends('layouts.app')

@section('title', 'LifeDrop - ডোনার লিস্ট')

@section('content')
<div class="bg-slate-50 min-h-screen py-10">
    <div class="container mx-auto px-4">

        <div class="mb-8 flex justify-between items-center">
            <div>
                <h2 class="text-2xl font-bold text-slate-800">
                    রক্তদাতা পাওয়া গেছে: <span class="text-[#E63946]">{{ $donors->total() }} জন</span>
                </h2>
                <p class="text-slate-500 text-sm mt-1">আপনার ক্রাইটেরিয়া অনুযায়ী ফলাফল নিচে দেওয়া হলো</p>
            </div>
            <a href="{{ route('home') }}" class="text-sm font-medium text-slate-600 hover:text-[#E63946] transition border border-slate-300 px-4 py-2 rounded-lg bg-white hover:bg-slate-50">
                &larr; নতুন সার্চ
            </a>
        </div>

        @if($donors->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($donors as $donor)
            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm hover:shadow-md transition p-5 relative overflow-hidden group">

                <div class="flex justify-between items-start mb-4">
                    <div class="flex gap-4">
                        <div class="w-14 h-14 rounded-full bg-slate-100 flex items-center justify-center text-xl font-bold text-slate-500 border border-slate-200">
                            {{ substr($donor->name, 0, 1) }}
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-slate-800 leading-tight">{{ $donor->name }}</h3>
                            <p class="text-xs text-slate-400 mt-1">Donor ID: LD-{{ 1000 + $donor->id }}</p>
                        </div>
                    </div>
                    <div class="bg-[#E63946] text-white text-sm font-bold px-3 py-1 rounded-full shadow-sm shadow-red-200">
                        {{ $donor->blood_group }}
                    </div>
                </div>

                <div class="space-y-2 text-sm text-slate-600 mb-6">
                    <div class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        <span>{{ $donor->upazila }}, {{ $donor->district }}</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span>সর্বশেষ দান: <span class="text-slate-400 italic">তথ্য নেই</span></span>
                    </div>
                    <div class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.384-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path>
                        </svg>
                        <span>মোট দান: <strong>০ বার</strong></span>
                    </div>
                    <div class="flex items-center gap-2 mt-2">
                        @if($donor->availability_status == 'ready')
                        <svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span class="text-green-600 font-medium">রক্ত দিতে প্রস্তুত</span>
                        @else
                        <svg class="w-4 h-4 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                        <span class="text-red-500 font-medium">বর্তমানে ব্যস্ত</span>
                        @endif
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-3">

                    <div id="contact-action-{{ $donor->id }}">
                        <button onclick="revealContact('{{ $donor->id }}', '{{ $donor->phone }}')"
                            class="w-full flex items-center justify-center gap-2 border border-slate-200 rounded-lg py-2 text-slate-700 font-medium hover:bg-slate-50 transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                            </svg>
                            সরাসরি কল
                        </button>
                    </div>

                    <button class="w-full bg-[#E63946] text-white font-bold py-2 rounded-lg hover:bg-red-700 transition shadow-sm shadow-red-200">
                        প্রোফাইল
                    </button>
                </div>

            </div>
            @endforeach
        </div>

        <div class="mt-8">
            {{ $donors->withQueryString()->links() }}
        </div>
        @else
        <div class="text-center py-20 bg-white rounded-xl border border-dashed border-slate-300">
            <h3 class="text-xl text-slate-600 font-medium">দুঃখিত, কোনো রক্তদাতা পাওয়া যায়নি।</h3>
            <p class="text-slate-500 mt-2">অন্য কোনো এলাকা বা রক্তের গ্রুপ দিয়ে চেষ্টা করুন।</p>
            <a href="{{ route('home') }}" class="inline-block mt-4 text-[#E63946] font-bold hover:underline">
                &larr; আবার সার্চ করুন
            </a>
        </div>
        @endif

    </div>
</div>

<script>
    function revealContact(id, phone) {
        const container = document.getElementById(`contact-action-${id}`);

        // বাটনের বদলে সরাসরি ফোন নম্বর এবং ডায়াল লিংক
        container.innerHTML = `
            <a href="tel:${phone}" class="w-full flex items-center justify-center gap-2 bg-red-50 border border-red-100 rounded-lg py-2 text-[#E63946] font-bold hover:bg-red-100 transition animate-pulse">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                ${phone}
            </a>
        `;
    }
</script>
@endsection