<div class="flex flex-col items-center h-full w-full py-6 px-4">
    <div class="font-bold text-2xl text-purple-600 mb-8">
        S.
    </div>

    <nav class="flex-1 w-full">

    </nav>

    @auth
        <div class="w-full">
            <form action="{{ route('logout.logout') }}" method="POST">
                @csrf
                <button class="w-full bg-purple-600 text-white py-2 rounded-full font-bold" type="submit">Logout</button>
            </form>
        </div>
    @endauth
</div>
