<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Socials</title>
    @vite('resources/css/app.css')
</head>

<body>
    <div class="flex min-h-screen w-full">
        <aside class="w-20 md:w-64 h-screen sticky top-0 border-r border-gray-200">
            <x-navbar class="w-full" />
        </aside>

        <main class="flex-1 p-6">
            {{ $slot }}
        </main>

        <footer>

        </footer>
    </div>
</body>

</html>
