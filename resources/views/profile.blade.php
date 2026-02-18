<x-layout title="{{ $user->name }}'s Profile">
    <div class="max-w-6xl mx-auto px-4 py-8">

        <div class="grid grid-cols-1 md:grid-cols-4 md:grid-rows-2 gap-6">

            <div
                class="md:col-span-1 md:row-span-2 bg-white p-8 rounded-[2.5rem] shadow-sm border border-slate-100 flex flex-col items-center justify-center text-center">
                <div
                    class="w-32 h-32 bg-indigo-600 rounded-4x mb-6 flex items-center justify-center text-4xl font-bold text-white shadow-xl shadow-indigo-100 rotate-3">
                    @if ($user->avatar)
                        <img src="{{ asset('storage/' . $user->avatar) }}" class="w-full h-full object-cover">
                    @else
                        <span class="text-4xl font-bold text-white">{{ substr($user->name, 0, 1) }}</span>
                    @endif

                </div>
                <h2 class="text-2xl font-black text-slate-900 tracking-tight">{{ $user->name }}</h2>
                <p class="text-indigo-600 font-bold text-sm">{{ '@' . $user->username }}</p>

                @if (auth()->id() === $user->id)
                    <a href="{{ route('profile.edit') }}"
                        class="mt-8 w-full py-4 bg-slate-900 hover:bg-indigo-600 text-white text-xs font-black uppercase tracking-widest rounded-2xl transition-all active:scale-95 shadow-lg">
                        Edit Profile
                    </a>
                @else
                    <button
                        class="mt-8 w-full py-4 bg-slate-900 hover:bg-indigo-600 text-white text-xs font-black uppercase tracking-widest rounded-2xl transition-all active:scale-95 shadow-lg">
                        Follow
                    </button>
                @endif

                @auth
                    @if(auth()->id() === $user->id)
                    <div class="md:hidden w-full pt-6 border-t border-slate-100 mt-4">
                        <form action="{{ route('logout.logout') }}" method="POST"
                            onsubmit="return confirm('Are you sure you want to logout?')">
                            @csrf
                            <button
                                class="w-full flex items-center justify-center gap-2 bg-red-50 text-red-600 py-4 rounded-2xl font-black text-xs uppercase tracking-widest border border-red-100 shadow-bento hover:bg-red-600 hover:text-white transition-all active:scale-95 cursor-pointer"
                                type="submit">
                                <svg class="w-4 h-4 transition-transform group-hover:-translate-x-1" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                        d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                </svg>
                                Logout
                            </button>
                        </form>
                    </div>
                    @endif
                @endauth
            </div>

            <div
                class="md:col-span-2 bg-white p-8 rounded-[2.5rem] shadow-sm border border-slate-100 flex items-center justify-around">
                <div class="text-center">
                    <span class="block text-4xl font-black text-slate-900">{{ $user->posts->count() }}</span>
                    <span class="text-slate-400 text-[10px] uppercase font-bold tracking-widest">Posts</span>
                </div>
                <div class="h-12 w-px bg-slate-100"></div>
                <div class="text-center">
                    <span
                        class="block text-4xl font-black text-slate-900">{{ $user->posts->sum(fn($p) => $p->likes->count()) }}</span>
                    <span class="text-slate-400 text-[10px] uppercase font-bold tracking-widest">Total Likes</span>
                </div>
            </div>

            <div
                class="md:col-span-1 bg-indigo-600 p-8 rounded-[2.5rem] shadow-xl shadow-indigo-100 text-white flex flex-col justify-center relative overflow-hidden">
                <div class="absolute -right-4 -top-4 w-20 h-20 bg-white/10 rounded-full"></div>

                <p class="text-indigo-200 text-[10px] uppercase font-black tracking-widest mb-1">Member Since</p>
                <p class="text-2xl font-bold">{{ $user->created_at->format('M Y') }}</p>
            </div>

            <div class="md:col-span-3 bg-slate-50 p-2 rounded-[2.5rem] border border-slate-100">
                <div class="bg-white h-full w-full rounded-4xl p-8">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-xs font-black text-slate-400 uppercase tracking-widest">Recent Posts</h3>
                        <a href="#" class="text-xs font-bold text-indigo-600 hover:underline">View all</a>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @forelse($user->posts->take(4) as $post)
                            <div
                                class="group p-5 rounded-3xl bg-slate-50 hover:bg-white hover:shadow-md hover:ring-1 hover:ring-slate-100 transition-all border border-transparent">
                                <p class="text-slate-600 text-sm font-medium line-clamp-2 leading-relaxed">
                                    {{ $post->content }}
                                </p>
                                <div class="mt-3 flex items-center text-[10px] text-slate-400 font-bold uppercase">
                                    <span>{{ $post->created_at->diffForHumans() }}</span>
                                    <span class="mx-2">•</span>
                                    <span>❤️ {{ $post->likes->count() }}</span>
                                </div>
                            </div>
                        @empty
                            <div class="col-span-2 text-center py-10">
                                <p class="text-slate-400 font-medium italic">No activity yet. Time to share something!
                                </p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-layout>
