<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Socials</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="bg-slate-50 antialiased text-slate-900">
    <div class="flex min-h-screen w-full">
        <aside class="w-20 md:w-64 h-screen sticky top-0 border-r border-slate-200 bg-white/80 backdrop-blur-md">
            <x-sidebar class="w-full" />
        </aside>

        <main class="flex-1 p-6">
            {{ $slot }}
        </main>
    </div>
</body>


</html>
