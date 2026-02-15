<x-layout title="Socials | Feed">
    <div class="max-w-6xl mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-12 gap-8 mt-8">

            <div class="hidden md:block md:col-span-3"></div>

            <div class="col-span-1 md:col-span-6">

                <div class="mb-8">
                    <h1 class="text-3xl font-black text-slate-900 tracking-tight leading-none">
                        Hey, {{ auth()->user()->name }}<span class="text-accent">!</span>
                    </h1>
                    <p class="text-slate-500 font-medium mt-2">Here's what's happening in your circle today.</p>
                </div>

                <div class="bg-white rounded-3xl p-6 mb-8 shadow-bento border border-slate-100">
                    <form action="{{ route('posts.store') }}" method="POST">
                        @csrf
                        <div class="flex items-start space-x-4">
                            <img src="https://ui-avatars.com/api/?name={{ auth()->user()->name }}&background=8b5cf6&color=fff"
                                class="w-12 h-12 rounded-2xl object-cover">

                            <textarea name="content"
                                class="flex-1 border-none focus:ring-0 resize-none text-lg font-normal placeholder-slate-400 min-h-20"
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
                        <div x-data="{ showReply: false }"
                            class="bg-white rounded-3xl p-6 shadow-bento border border-slate-50 hover:border-purple-100 transition-colors group">
                            <div class="flex items-center mb-4">
                                <div class="mr-4 shrink-0">
                                    <img src="https://ui-avatars.com/api/?name={{ urlencode($post->user->name) }}&background=random"
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

                            @if ($post->comments->count() > 0)
                                <div class="mt-6 space-y-4 border-t border-slate-50 pt-4">
                                    @foreach ($post->comments as $comment)
                                        <div class="flex items-start space-x-3 group/comment">
                                            <img src="https://ui-avatars.com/api/?name={{ urlencode($comment->user->name) }}&background=random"
                                                class="w-8 h-8 rounded-xl object-cover border border-slate-100 shrink-0">

                                            <div
                                                class="flex-1 bg-slate-50 rounded-2xl px-4 py-2.5 transition-colors group-hover/comment:bg-slate-100/50">
                                                <div class="flex justify-between items-center">
                                                    <h5 class="text-[13px] font-bold text-slate-900">
                                                        {{ $comment->user->name }}</h5>
                                                    <span
                                                        class="text-[10px] font-medium text-slate-400">{{ $comment->created_at->diffForHumans(short: true) }}</span>
                                                </div>
                                                <p class="text-sm text-slate-600 leading-snug mt-0.5">
                                                    {{ $comment->content }}
                                                </p>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif

                            <div class="mt-6 flex items-center space-x-6 pl-1">
                                <form action="{{ route('posts.like.store', $post) }}" method="POST">
                                    @csrf
                                    <button type="submit"
                                        class="flex items-center space-x-2 transition-all active:scale-90 {{ $post->isLikedBy(auth()->user()) ? 'text-red-500' : 'text-slate-400 hover:text-red-500' }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                            fill="{{ $post->isLikedBy(auth()->user()) ? 'currentColor' : 'none' }}"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                        </svg>
                                        <span
                                            class="text-xs font-bold uppercase tracking-wider">{{ $post->likes->count() }}</span>
                                    </button>
                                </form>

                                <button type="button" @click="showReply = !showReply"
                                    class="flex items-center space-x-2 text-slate-400 hover:text-accent transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                                    </svg>
                                    <span class="text-xs font-bold uppercase tracking-wider">Reply</span>
                                </button>
                            </div>

                            <div x-show="showReply" x-transition:enter="transition ease-out duration-200"
                                x-transition:enter-start="opacity-0 -translate-y-2"
                                x-transition:enter-end="opacity-100 translate-y-0"
                                class="mt-4 pt-4 border-t border-slate-50">

                                <form action="{{ route('posts.comment.store', $post) }}" method="POST"
                                    class="flex items-end space-x-3">
                                    @csrf
                                    <div
                                        class="flex-1 bg-slate-50 rounded-2xl px-4 py-2 border border-transparent focus-within:border-purple-100 focus-within:bg-white transition-all">
                                        <textarea name="content" rows="1" placeholder="Write a comment..."
                                            class="w-full bg-transparent border-none focus:ring-0 text-sm p-0 resize-none placeholder-slate-400"></textarea>
                                    </div>
                                    <button type="submit"
                                        class="bg-accent text-white p-2 rounded-xl hover:bg-purple-700 transition-all shadow-sm">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                                            <path d="M5 12h14M12 5l7 7-7 7" />
                                        </svg>
                                    </button>
                                </form>
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
