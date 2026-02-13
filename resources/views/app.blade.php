<x-layout>
    <div class="max-w-6xl mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-12 gap-8 mt-8">

            <div class="hidden md:block md:col-span-3"></div>

            <div class="col-span-1 md:col-span-6">

                <div class="bg-white rounded-3xl p-6 mb-8 shadow-bento border border-slate-100">
                    <form action="{{ route('posts.store') }}" method="POST">
                        @csrf
                        <div class="flex items-start space-x-4">
                            <img src="https://ui-avatars.com/api/?name={{ auth()->user()->name }}&background=8b5cf6&color=fff"
                                 class="w-12 h-12 rounded-2xl object-cover">

                            <textarea name="content"
                                class="flex-1 border-none focus:ring-0 resize-none text-lg font-normal placeholder-slate-400 min-h-[80px]"
                                placeholder="What's happening?"></textarea>
                        </div>

                        @error('content')
                            <span class="text-red-500 text-sm ml-16 block">{{ $message }}</span>
                        @enderror

                        <div class="flex justify-end mt-2">
                            <button type="submit"
                                class="bg-accent text-white font-bold rounded-xl px-6 py-2.5 hover:bg-purple-700 transition-all shadow-md active:scale-95">
                                Post
                            </button>
                        </div>
                    </form>
                </div>

                <div class="space-y-6">
                    @forelse ($posts as $post)
                        <div class="bg-white rounded-3xl p-6 shadow-bento border border-slate-50 hover:border-purple-100 transition-colors group">
                            <div class="flex items-center mb-4">
                                <div class="mr-4 shrink-0">
                                    <img src="https://ui-avatars.com/api/?name={{ urlencode($post->user->name) }}&background=f1f5f9&color=64748b"
                                        alt="{{ $post->user->name }}"
                                        class="h-12 w-12 rounded-2xl object-cover border border-slate-100">
                                </div>

                                <div class="flex flex-col">
                                    <h4 class="font-bold text-slate-900 leading-none">{{ $post->user->name }}</h4>
                                    <span class="text-slate-400 text-sm mt-1">
                                        {{ '@' . Str::slug($post->user->name, '') }}
                                    </span>
                                </div>
                            </div>

                            <p class="text-slate-700 text-[17px] leading-relaxed pl-1">
                                {{ $post->content }}
                            </p>

                            <div class="mt-6 flex items-center space-x-6 pl-1">
                                <button class="flex items-center space-x-2 text-slate-400 hover:text-red-500 transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" /></svg>
                                    <span class="text-xs font-bold uppercase tracking-wider">Like</span>
                                </button>
                                <button class="flex items-center space-x-2 text-slate-400 hover:text-accent transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" /></svg>
                                    <span class="text-xs font-bold uppercase tracking-wider">Reply</span>
                                </button>
                            </div>
                        </div>
                    @empty
                        <div class="bg-slate-50 rounded-3xl p-12 text-center border-2 border-dashed border-slate-200">
                            <p class="text-slate-400 font-medium">No posts here yet...</p>
                        </div>
                    @endforelse
                </div>
            </div>

            <div class="hidden lg:block lg:col-span-3"></div>
        </div>
    </div>
</x-layout>
