<x-layout>
    <div class="flex h-screen">

        <div class="hidden md:flex w-1/2 bg-gradient-to-br from-purple-500 to-indigo-600 justify-center items-center">

        </div>

        <div class="flex w-full justify-center items-center p-8">
            <form class="w-full max-w-md bg-white rounded-xl shadow-lg p-8 space-y-4"
                action="{{ route('register.store') }}" method="POST">
                @csrf

                <h2 class="text-2xl font-bold text-center mb-6">Create Account</h2>

                <div>
                    <label class="block text-gray-700">Name</label>
                    <input type="text" name="name"
                        class="w-full border-b-2 border-gray-300 focus:border-purple-500 focus:outline-none py-2">
                </div>

                <div>
                    <label class="block text-gray-700">Email</label>
                    <input type="email" name="email"
                        class="w-full border-b-2 border-gray-300 focus:border-purple-500 focus:outline-none py-2">
                </div>

                <div>
                    <label class="block text-gray-700">Password</label>
                    <input type="password" name="password"
                        class="w-full border-b-2 border-gray-300 focus:border-purple-500 focus:outline-none py-2">
                </div>

                <div>
                    <label class="block text-gray-700">Confirm Password</label>
                    <input type="password" name="password_confirmation"
                        class="w-full border-b-2 border-gray-300 focus:border-purple-500 focus:outline-none py-2">
                </div>

                <button type="submit"
                    class="w-full bg-purple-500 hover:bg-purple-600 text-white font-bold py-2 rounded transition">
                    Register
                </button>
            </form>
        </div>
    </div>
</x-layout>
