<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Socials' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="bg-slate-50 antialiased text-slate-900">
    <div class="flex min-h-screen w-full">
        <aside class="hidden md:block w-20 md:w-64 h-screen sticky top-0 border-r border-slate-200 bg-white/80 backdrop-blur-md">
            <x-sidebar class="w-full" />
        </aside>

        <main class="flex-1 p-6">
            {{ $slot }}
        </main>

        <x-flash />
    </div>

    <div
        class="md:hidden fixed bottom-0 left-0 right-0 bg-white/90 backdrop-blur-xl border-t border-slate-100 px-8 py-4 z-50">
        <div class="flex justify-between items-center max-w-md mx-auto">
            <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'text-accent' : 'text-slate-400' }}">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                        d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                    </path>
                </svg>
            </a>

            {{-- Post Button (The Floating look) --}}
            <a href="#post-form"
                class="bg-accent text-white p-3 rounded-2xl shadow-lg -mt-12 border-4 border-slate-50 active:scale-90 transition-transform">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4"></path>
                </svg>
            </a>

            {{-- Profile --}}
            <a href="{{ route('profile.show', auth()->user()->username) }}"
                class="shrink-0 {{ request()->routeIs('profile.show') ? 'ring-2 ring-accent ring-offset-2' : '' }} rounded-xl overflow-hidden">
                <img src="https://ui-avatars.com/api/?name={{ auth()->user()->name }}&background=8b5cf6&color=fff"
                    class="w-8 h-8 object-cover">
            </a>
        </div>
    </div>
</body>

</html>
