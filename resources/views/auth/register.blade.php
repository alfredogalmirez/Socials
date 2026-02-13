<x-auth>
    <div class="min-h-screen w-full flex items-center justify-center bg-[#f8fafc] p-4">

        <div class="flex flex-col-reverse md:flex-row w-full max-w-5xl bg-white rounded-[2.5rem] shadow-bento overflow-hidden border border-slate-100">

            <div class="flex-1 p-8 md:p-16 flex flex-col justify-center">
                <div class="max-w-sm mx-auto w-full">
                    <h2 class="text-3xl font-black text-slate-900 mb-2 tracking-tight">Create Account</h2>
                    <p class="text-slate-500 font-medium mb-8">Join the community today.</p>

                    <form action="{{ route('register.store') }}" method="POST" class="space-y-5">
                        @csrf

                        <div class="space-y-1">
                            <label class="block text-sm font-bold text-slate-700 ml-1">Full Name</label>
                            <input type="text" name="name"
                                class="w-full bg-slate-50 border-none rounded-2xl py-4 px-5 focus:ring-2 focus:ring-accent/20 transition-all placeholder:text-slate-300"
                                placeholder="John Doe" value="{{ old('name') }}">
                            @error('name') <span class="text-xs text-red-500 ml-1">{{ $message }}</span> @enderror
                        </div>

                        <div class="space-y-1">
                            <label class="block text-sm font-bold text-slate-700 ml-1">Email</label>
                            <input type="email" name="email"
                                class="w-full bg-slate-50 border-none rounded-2xl py-4 px-5 focus:ring-2 focus:ring-accent/20 transition-all placeholder:text-slate-300"
                                placeholder="name@email.com" value="{{ old('email') }}">
                            @error('email') <span class="text-xs text-red-500 ml-1">{{ $message }}</span> @enderror
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="space-y-1">
                                <label class="block text-sm font-bold text-slate-700 ml-1">Password</label>
                                <input type="password" name="password"
                                    class="w-full bg-slate-50 border-none rounded-2xl py-4 px-5 focus:ring-2 focus:ring-accent/20 transition-all placeholder:text-slate-300"
                                    placeholder="••••••••">
                            </div>
                            <div class="space-y-1">
                                <label class="block text-sm font-bold text-slate-700 ml-1">Confirm</label>
                                <input type="password" name="password_confirmation"
                                    class="w-full bg-slate-50 border-none rounded-2xl py-4 px-5 focus:ring-2 focus:ring-accent/20 transition-all placeholder:text-slate-300"
                                    placeholder="••••••••">
                            </div>
                        </div>
                        @error('password') <span class="text-xs text-red-500 ml-1">{{ $message }}</span> @enderror

                        <button type="submit"
                            class="w-full bg-accent hover:bg-purple-700 text-white font-bold py-4 rounded-2xl shadow-lg shadow-accent/25 transition-all active:scale-[0.98] mt-4">
                            Get Started
                        </button>

                        <p class="text-center text-slate-500 text-sm font-medium mt-6">
                            Already a member?
                            <a href="{{ route('login') }}" class="text-accent font-bold hover:underline">Login here</a>
                        </p>
                    </form>
                </div>
            </div>

            <div class="hidden md:flex md:w-5/12 bg-gradient-to-br from-indigo-600 to-accent p-12 flex-col justify-between text-white text-right">
                <div class="text-3xl font-black italic tracking-tighter">S.</div>

                <div>
                    <h2 class="text-4xl font-bold leading-tight">Start sharing <br>your story.</h2>
                    <p class="mt-4 text-purple-100 font-medium text-balance">Join thousands of creators in a space designed for clarity and connection.</p>
                </div>

                <div class="text-sm text-purple-200 uppercase tracking-widest font-bold">New Era</div>
            </div>

        </div>
    </div>
</x-auth>
