<div class="flex flex-col items-center h-full w-full py-6 px-4 bg-white border-r border-slate-100">
    <div class="font-bold text-3xl text-brand mb-10 tracking-tight">
        S<span class="text-slate-300">.</span>
    </div>

    <nav class="flex-1 w-full space-y-1">
        <a href="#" class="flex items-center w-full px-4 py-3 bg-brand/10 text-brand rounded-xl font-semibold transition-all">
            Home
        </a>

        <a href="#" class="flex items-center w-full px-4 py-3 text-slate-500 hover:bg-slate-50 rounded-xl font-medium transition-all">
            Explore
        </a>
    </nav>

    @auth
        <div class="w-full pt-4">
            <form action="{{ route('logout.logout') }}" method="POST">
                @csrf
                <button class="w-full bg-slate-900 text-white py-3 rounded-xl font-bold shadow-bento hover:bg-black transition-all" type="submit">
                    Logout
                </button>
            </form>
        </div>
    @endauth
</div>
