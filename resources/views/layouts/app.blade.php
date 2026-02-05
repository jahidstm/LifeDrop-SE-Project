<!DOCTYPE html>
<html lang="bn">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'LifeDrop - রক্ত দিন, জীবন বাঁচান')</title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Hind+Siliguri:wght@400;500;600;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Inter', 'Hind Siliguri', sans-serif;
        }
    </style>
</head>

<body class="bg-slate-50 text-slate-900 antialiased">

    <header class="sticky top-0 z-50 w-full border-b bg-white/95 backdrop-blur shadow-sm">
        <div class="container mx-auto flex h-16 items-center justify-between px-4">
            <a href="{{ url('/') }}" class="flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#E63946" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-6 w-6">
                    <path d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z" />
                    <polyline points="14 2 14 8 20 8" />
                    <path d="M12 13v6" />
                    <path d="M12 19l-3-3" />
                    <path d="M12 19l3-3" />
                </svg>
                <span class="text-xl font-bold text-slate-900">LifeDrop</span>
            </a>

            <nav class="hidden md:flex gap-6">
                <a href="{{ url('/') }}" class="text-sm font-medium hover:text-[#E63946]">হোম</a>
                <a href="#" class="text-sm font-medium hover:text-[#E63946]">রক্ত দিন</a>
                <a href="#" class="text-sm font-medium hover:text-[#E63946]">রক্তের অনুরোধ</a>
            </nav>

            <div class="flex items-center gap-4">
                @auth
                <a href="{{ url('/dashboard') }}" class="text-sm font-medium">ড্যাশবোর্ড</a>
                @else
                <a href="{{ route('login') }}" class="text-sm font-medium hover:text-[#E63946]">লগিন</a>
                <a href="{{ route('register') }}" class="bg-[#E63946] text-white px-4 py-2 rounded-md text-sm font-medium hover:bg-red-700 transition">
                    ডোনার হোন
                </a>
                @endauth
            </div>
        </div>
    </header>

    <main>
        @yield('content')
    </main>

    <footer class="bg-white border-t mt-12 py-8">
        <div class="container mx-auto px-4 text-center text-slate-500 text-sm">
            <p>&copy; {{ date('Y') }} LifeDrop. সর্বস্বত্ব সংরক্ষিত।</p>
        </div>
    </footer>

</body>

</html>