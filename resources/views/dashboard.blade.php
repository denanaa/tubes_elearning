<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-gray-100 h-screen">
    <div class="flex h-full">
        <!-- Sidebar -->
        <aside class="w-64 bg-[#37AFE1] text-white flex flex-col">
            <!-- Header -->
            <div class="p-4 text-2xl font-bold mb-6">BinaBahasa</div>
            
            <!-- Navigation -->
            <nav class="flex-grow">
                <ul>
                    <!-- Menu Home -->
                    <li class="px-4 py-2 hover:bg-white hover:text-[#37AFE1] group">
                        <a href="dashboard" class="flex items-center space-x-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 group-hover:text-[#37AFE1]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 9.75L12 3l9 6.75M4.5 10.5v8.25A2.25 2.25 0 006.75 21h10.5a2.25 2.25 0 002.25-2.25V10.5M9 21V12h6v9" />
                            </svg>
                            <span>Home</span>
                        </a>
                    </li>
                    
                    <li x-data="{ open: false }" class="px-4 py-2 hover:bg-white hover:text-[#37AFE1] group">
                        <a href="#" @click.prevent="open = !open" class="flex items-center justify-between">
                            <span class="flex items-center space-x-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 group-hover:text-[#37AFE1]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 10h16M4 14h16M4 18h16" />
                                </svg>
                                <span>Data</span>
                            </span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" :class="{'rotate-180': open}" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 9l6 6 6-6" />
                            </svg>
                        </a>
                        <!-- Submenu -->
                        <ul x-show="open" x-transition class="ml-6 mt-2 space-y-1">
                            <li class="px-4 py-2 hover:bg-[#37AFE1] hover:text-white rounded group">
                                <a href="data-user" class="flex items-center space-x-3">
                                    <span>Data User</span>
                                </a>
                            </li>
                            <li class="px-4 py-2 hover:bg-[#37AFE1] hover:text-white rounded group">
                                <a href="data-modul" class="flex items-center space-x-3">
                                    <span>Data Modul</span>
                                </a>
                            </li>
                            <li class="px-4 py-2 hover:bg-[#37AFE1] hover:text-white rounded group">
                                <a href="data-kategori" class="flex items-center space-x-3">
                                    <span>Data Kategori</span>
                                </a>
                            </li>
                            <li class="px-4 py-2 hover:bg-[#37AFE1] hover:text-white rounded group">
                                <a href="data-video" class="flex items-center space-x-3">
                                    <span>Data Video</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </nav>
            
            <!-- Footer -->
            <footer class="p-4 text-center">&copy; 2024</footer>
        </aside>
        
        <!-- Main Content -->
        <main class="flex-grow p-6">
            <h1 class="text-2xl font-bold mb-4">Dashboard</h1>
        </main>
    </div>
</body>
</html>
