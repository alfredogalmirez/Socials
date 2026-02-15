<x-auth>
    <div class="min-h-screen w-full flex items-center justify-center bg-bento-bg p-4">

        <div
            class="flex flex-col md:flex-row w-full max-w-5xl bg-white rounded-[2.5rem] shadow-bento overflow-hidden border border-slate-100">

            <div
                class="hidden md:flex md:w-5/12 bg-linear-to-br from-accent to-indigo-600 p-12 flex-col justify-between text-white">
                <div class="text-3xl font-black italic tracking-tighter">S.</div>

                <div>
                    <h2 class="text-4xl font-bold leading-tight">Connect with the <br>inner circle.</h2>
                    <p class="mt-4 text-purple-100 font-medium">Experience the new wave of social interaction.</p>
                </div>

                <div class="text-sm text-purple-200">© 2026 Socials Platform by Alfredo Almirez</div>
            </div>

            <div class="flex-1 p-8 md:p-16 flex flex-col justify-center">
                <div class="max-w-sm mx-auto w-full">
                    <h2 class="text-3xl font-black text-slate-900 mb-2 tracking-tight">Log in</h2>
                    <p class="text-slate-500 font-medium mb-8">Great to see you again!</p>

                    <form action="{{ route('login.login') }}" method="POST" class="space-y-6">
                        @csrf

                        @if ($errors->any())
                            <div
                                class="bg-red-300 border border-red-100 text-red-600 px-4 py-3 rounded-2xl flex items-center space-x-2 mb-6 animate-pulse">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 shrink-0" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                        clip-rule="evenodd" />
                                </svg>
                                <p class="text-sm font-bold uppercase tracking-wide">Invalid credentials. Please try
                                    again.</p>
                            </div>
                        @endif

                        <div class="space-y-2">
                            <label class="block text-sm font-bold text-slate-700 ml-1">Email</label>
                            <input type="email" name="email"
                                class="w-full bg-slate-50 border-none rounded-2xl py-4 px-5 focus:ring-2 focus:ring-accent/20 transition-all placeholder:text-slate-300"
                                placeholder="name@email.com">
                        </div>

                        <div class="space-y-2">
                            <label class="block text-sm font-bold text-slate-700 ml-1">Password</label>
                            <input type="password" name="password"
                                class="w-full bg-slate-50 border-none rounded-2xl py-4 px-5 focus:ring-2 focus:ring-accent/20 transition-all placeholder:text-slate-300"
                                placeholder="••••••••">
                        </div>

                        <button type="submit"
                            class="w-full bg-accent hover:bg-purple-700 text-white font-bold py-4 rounded-2xl shadow-lg shadow-accent/25 transition-all active:scale-[0.98] mt-4">
                            Log In
                        </button>

                        <p class="text-center text-slate-500 text-sm font-medium mt-6">
                            Don't have an account?
                            <a href="{{ route('register.create') }}" class="text-accent font-bold hover:underline">Join
                                now</a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-auth>
