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
        <!-- Navigation -->
        <div x-data="{ showSidebar: false }" class="relative flex w-full flex-col md:flex-row">

            <nav x-cloak
                class="fixed left-0 z-20 flex h-svh w-60 shrink-0 flex-col border-r border-neutral-300 bg-[#37AFE1] p-4 transition-transform duration-300 md:w-64 md:translate-x-0 md:relative"
                x-bind:class="showSidebar ? 'translate-x-0' : '-translate-x-60'" aria-label="sidebar navigation">
                <!-- logo  -->
                <div class="p-2 text-2xl font-bold mb-6 text-white">BinaBahasa</div>


                <!-- sidebar links  -->
                <div class="flex flex-col gap-2 overflow-y-auto pb-6 my-8">

                    <a href="dashboard"
                        class="flex items-center rounded-md gap-2 px-2 py-1.5 text-sm font-medium text-white underline-offset-2 hover:bg-white hover:text-[#37AFE1] focus-visible:underline focus:outline-none">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                            class="size-5 shrink-0" aria-hidden="true">
                            <path
                                d="M15.5 2A1.5 1.5 0 0 0 14 3.5v13a1.5 1.5 0 0 0 1.5 1.5h1a1.5 1.5 0 0 0 1.5-1.5v-13A1.5 1.5 0 0 0 16.5 2h-1ZM9.5 6A1.5 1.5 0 0 0 8 7.5v9A1.5 1.5 0 0 0 9.5 18h1a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 10.5 6h-1ZM3.5 10A1.5 1.5 0 0 0 2 11.5v5A1.5 1.5 0 0 0 3.5 18h1A1.5 1.5 0 0 0 6 16.5v-5A1.5 1.5 0 0 0 4.5 10h-1Z" />
                        </svg>
                        <span>Dashboard</span>
                    </a>

                    <!-- collapsible item  -->
                    <div x-data="{ isExpanded: false }" class="flex flex-col">
                        <button type="button" x-on:click="isExpanded = ! isExpanded" id="user-management-btn"
                            aria-controls="user-management" x-bind:aria-expanded="isExpanded ? 'true' : 'false'"
                            class="flex items-center justify-between rounded-md gap-2 px-2 py-1.5 text-sm font-medium underline-offset-2 focus:outline-none focus-visible:underline"
                            x-bind:class="isExpanded ? 'text-[#37AFE1] bg-white' : 'text-white hover:bg-white hover:text-[#37AFE1]'">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" fill="currentColor"
                                class="size-5 transition-transform rotate-0 shrink-0">
                                <path
                                    d="M448 80l0 48c0 44.2-100.3 80-224 80S0 172.2 0 128L0 80C0 35.8 100.3 0 224 0S448 35.8 448 80zM393.2 214.7c20.8-7.4 39.9-16.9 54.8-28.6L448 288c0 44.2-100.3 80-224 80S0 332.2 0 288L0 186.1c14.9 11.8 34 21.2 54.8 28.6C99.7 230.7 159.5 240 224 240s124.3-9.3 169.2-25.3zM0 346.1c14.9 11.8 34 21.2 54.8 28.6C99.7 390.7 159.5 400 224 400s124.3-9.3 169.2-25.3c20.8-7.4 39.9-16.9 54.8-28.6l0 85.9c0 44.2-100.3 80-224 80S0 476.2 0 432l0-85.9z" />
                            </svg>
                            <span class="mr-auto text-left">Data</span>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                class="size-5 transition-transform rotate-0 shrink-0"
                                x-bind:class="isExpanded ? 'rotate-180' : 'rotate-0'" aria-hidden="true">
                                <path fill-rule="evenodd"
                                    d="M5.22 8.22a.75.75 0 0 1 1.06 0L10 11.94l3.72-3.72a.75.75 0 1 1 1.06 1.06l-4.25 4.25a.75.75 0 0 1-1.06 0L5.22 9.28a.75.75 0 0 1 0-1.06Z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>

                        <ul x-cloak x-collapse x-show="isExpanded" aria-labelledby="user-management-btn"
                            id="user-management">
                            <li class="px-1 py-0.5 first:mt-2">
                                <a href="data-user"
                                    class="flex items-center rounded-md gap-2 px-2 py-1.5 text-sm font-medium text-white underline-offset-2 hover:bg-white hover:text-[#37AFE1] focus-visible:underline focus:outline-none">Data
                                    User</a>
                            </li>
                            <li class="px-1 py-0.5 first:mt-2">
                                <a href="data-modul"
                                    class="flex items-center rounded-md gap-2 px-2 py-1.5 text-sm font-medium text-white underline-offset-2 hover:bg-white hover:text-[#37AFE1] focus-visible:underline focus:outline-none">Data
                                    Modul</a>
                            </li>
                            <li class="px-1 py-0.5 first:mt-2">
                                <a href="data-kategori"
                                    class="flex items-center rounded-md gap-2 px-2 py-1.5 text-sm font-medium text-white underline-offset-2 hover:bg-white hover:text-[#37AFE1] focus-visible:underline focus:outline-none">Data
                                    Kategori</a>
                            </li>
                            <li class="px-1 py-0.5 first:mt-2">
                                <a href="data-video"
                                    class="flex items-center rounded-md gap-2 px-2 py-1.5 text-sm font-medium text-white underline-offset-2 hover:bg-white hover:text-[#37AFE1] focus-visible:underline focus:outline-none">Data
                                    Video</a>
                            </li>
                        </ul>
                    </div>
                    <a href="{{ route('welcome') }}"
                        class="flex items-center rounded-md gap-2 px-2 py-1.5 text-sm font-medium text-white underline-offset-2 hover:bg-white hover:text-[#37AFE1] focus-visible:underline focus:outline-none">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" fill="currentColor"
                            class="size-5 transition-transform rotate-0 shrink-0">
                            <path
                                d="M377.9 105.9L500.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L377.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1-128 0c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM160 96L96 96c-17.7 0-32 14.3-32 32l0 256c0 17.7 14.3 32 32 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-64 0c-53 0-96-43-96-96L0 128C0 75 43 32 96 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32z" />
                        </svg>
                        <span>Logout</span>
                    </a>
                </div>
            </nav>

            <!-- Main Content -->
            <main class="flex-grow p-6">
                <h1 class="text-2xl font-bold mb-4">Dashboard</h1>
            </main>
        </div>
</body>

</html>
