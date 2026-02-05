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
        <div class="bg-white border rounded-xl shadow-sm hover:shadow-md transition p-6 text-center group relative overflow-hidden">

            <div class="w-16 h-16 bg-red-50 text-[#E63946] rounded-full flex items-center justify-center text-2xl font-bold mx-auto mb-4 border border-red-100 group-hover:bg-[#E63946] group-hover:text-white transition">
                {{ $donor->blood_group }}
            </div>

            <h3 class="text-xl font-bold text-slate-800">{{ $donor->name }}</h3>
            <p class="text-slate-500 text-sm mt-1">
                <span class="font-medium">জেলা:</span> {{ $donor->district }} <br>
                <span class="font-medium">উপজেলা:</span> {{ $donor->upazila }}
            </p>

            <div class="mt-4 border-t pt-4" id="contact-box-{{ $donor->id }}">
                @auth
                <button onclick="revealPhone('{{ $donor->id }}', '{{ $donor->phone }}')"
                    class="w-full bg-slate-900 text-white py-2 rounded-md text-sm font-medium hover:bg-[#E63946] transition flex items-center justify-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z" />
                    </svg>
                    কল করুন
                </button>
                @else
                <a href="{{ route('login') }}" class="block w-full bg-slate-100 text-slate-600 py-2 rounded-md text-sm font-medium hover:bg-slate-200 transition">
                    নম্বর দেখতে লগিন করুন
                </a>
                @endauth
            </div>

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

<script>
    function revealPhone(donorId, phoneNumber) {
        const contactBox = document.getElementById(`contact-box-${donorId}`);

        contactBox.innerHTML = `
            <div class="animate-pulse bg-red-50 p-2 rounded-md border border-red-100">
                <a href="tel:${phoneNumber}" class="text-xl font-bold text-[#E63946] hover:underline flex items-center justify-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                    ${phoneNumber}
                </a>
                <p class="text-xs text-slate-500 mt-1">LifeDrop থেকে কল করেছেন জানান।</p>
            </div>
        `;
    }
</script>
@endsection