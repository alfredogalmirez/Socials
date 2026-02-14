<div class="flex flex-col items-center h-full w-full py-8 px-5 bg-[--color-card] border-r border-slate-200/60">
    <div class="w-full px-4 mb-10">
        <div class="text-3xl font-black text-accent tracking-tighter italic">
            S<span class="text-slate-300">.</span>
        </div>
    </div>

    <nav class="flex-1 w-full space-y-2">
        <a href="#" class="group flex items-center w-full px-4 py-3.5 bg-accent/10 text-accent rounded-2xl font-bold transition-all hover:bg-accent/20">
            <span class="flex items-center">
                <span class="w-1.5 h-1.5 rounded-full bg-accent mr-3"></span>
                Home
            </span>
        </a>

        <a href="#" class="flex items-center w-full px-4 py-3.5 text-slate-500 hover:text-slate-900 hover:bg-slate-50 rounded-2xl font-semibold transition-all">
            <span class="flex items-center pl-4">Explore</span>
        </a>
    </nav>

    @auth
        <div class="w-full pt-6 border-t border-slate-100">
            <form action="{{ route('logout.logout') }}" method="POST">
                @csrf
                <button class="w-full bg-slate-900 text-white py-3.5 rounded-2xl font-bold shadow-bento hover:bg-black transition-all active:scale-[0.97] cursor-pointer" type="submit">
                    Logout
                </button>
            </form>
        </div>
    @endauth
</div>
