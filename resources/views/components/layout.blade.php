<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BinaBahasa</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

</head>
<body class="h-full bg-[#FAF6F2]">

    <!-- Navbar -->
    <x-header></x-header>
    <x-navbar></x-navbar>

    <!-- Main Content -->
    <main class="w-full">
        <div class="w-full mx-auto">
            {{ $slot }}
        </div>
    </main>

    <x-footer></x-footer>

</body>
</html>