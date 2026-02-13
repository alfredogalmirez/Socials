@if (session()->has('success'))
    <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)" x-show="show" x-transition.duration.500ms
        class="fixed bottom-4 right-4 bg-purple-600 text-white px-6 py-3 rounded-xl shadow-lg flex items-center space-x-2">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
        </svg>
        <p class="font-bold">{{ session('success') }}</p>
    </div>
@endif
