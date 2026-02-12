<x-layout>
    <div class="max-w-6xl mx-auto">
        <div class="grid grid-cols-1 md:grid-cols-12 gap-4 mt-6">

            <div class="hidden md:block md:col-span-3 bg-red-100">

            </div>

            <div class="col-span-1 md:col-span-6 bg-gray-50">
                <div class="bg-white border border-gray-200 rounded-xl p-4 mb-6 shadow-sm">
                    <form action="{{ route('posts.store') }}" method="POST">
                        @csrf
                        <div class="flex items-start space-x-3">
                            <img src="https://ui-avatars.com/api/?name={{ auth()->user()->name }}" alt="Profile Picture"
                                class="w-10 h-10 rounded-full">
                            <textarea name="content" class="flex-1 border-none focus-ring-0 resize-none text-lg" placeholder="What's on your mind?"></textarea>
                        </div>

                        @error('content')
                            <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                        @enderror

                        <div class="flex justify-end mt-2 pt-2 border-t border-gray-100">
                            <button type="submit"
                                class="bg-black hover:bg-purple-600 text-white font-bold py-2 px-6 rounded-full transition-colors">Share</button>
                        </div>
                    </form>
                </div>

                @forelse ($posts as $post)
                    <div class="bg-white border border-gray-200 p-4 mb-4">{{ $post->content }}</div>
                @empty
                    <div class="bg-white border border-gray-200 p-4 mb-4">No Post Yet!</div>
                @endforelse
            </div>

            <div class="hidden lg:block lg:col-span-3 bg-green-100">

            </div>
        </div>
    </div>

</x-layout>
