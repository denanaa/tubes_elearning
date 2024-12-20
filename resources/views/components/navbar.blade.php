<div class="w-full">
    <div class="flex items-center justify-between w-full relative">
            <!-- Logo -->
            <div class="px-4">
                <a href="#home" class="font-bold italic text-lg text-[#37AFE1] block py-6">BinaBahasa</a>
            </div>

            <!-- Navigasi dan Tombol -->
            <div class="flex items-center px-4">
                <!-- Tombol Hamburger (hanya layar kecil) -->
                <button 
                    @click="isHamburgerActive = !isHamburgerActive" 
                    type="button" 
                    class="block lg:hidden"
                >
                    <!-- Garis 1 -->
                    <span 
                        class="hamburger-line transition duration-300 ease-in-out origin-top-left" 
                        :class="{ 'rotate-45': isHamburgerActive }"
                    ></span>
                    <!-- Garis 2 -->
                    <span 
                        class="hamburger-line transition duration-300 ease-in-out"
                        :class="{ 'opacity-0': isHamburgerActive }"
                    ></span>
                    <!-- Garis 3 -->
                    <span 
                        class="hamburger-line transition duration-300 ease-in-out origin-bottom-left" 
                        :class="{ '-rotate-45': isHamburgerActive }"
                    ></span>
                </button>

                <!-- Menu Navigasi -->
                <nav 
                    :class="{ 'hidden': !isHamburgerActive }" 
                    class="absolute py-5 bg-[#FAF6F2] shadow-lg rounded-lg max-w-[250px] w-full right-4 top-full lg:block lg:static lg:bg-transparent lg:max-w-full lg:shadow-none lg:rounded-none flex flex-col"
                >
                    <ul class="block lg:flex lg:items-center lg:gap-8">
                        <li class="group">
                            <a href="#home" class="text-base font-semibold text-black py-2 mx-8 flex group-hover:text-[#37AFE1]" :class="{ 'text-blue-500 border-b-2 border-blue-500': activePage === 'home' }"
                            @click="activePage = 'home'">Home</a>
                        </li>
                        <li class="group">
                            <a href="#content" class="text-base font-semibold text-black py-2 mx-8 flex group-hover:text-[#37AFE1]">Content</a>
                        </li>
                        <li class="group">
                            @guest
                                <a 
                                    href="{{ route('login') }}" 
                                    class="text-base font-semibold text-white bg-[#37AFE1] py-2 px-6 mx-8 rounded-lg flex hover:bg-gray-400 hover:text-black transition duration-300 ease-in-out"
                                >
                                    Login
                                </a>
                            @else
                                <div x-data="{ open: false }" @click.outside="open=false" class="relative text-sm py-2 pr-4">
                                    <button @click="open=!open" 
                                    class="inline-flex items-center justify-start px-3 py-1 mx-8 lg:mx-0 bg-white border rounded-lg shadow-sm hover:bg-gray-100 active:bg-gray-200 focus:outline-none focus:ring-1 border-gray-300 transition duration-300 ease-in-out transform hover:scale-105">
                                
                                    <!-- Foto Profil -->
                                    <img src="{{ Auth::user()->profile_image ? asset('storage/' . Auth::user()->profile_image) : asset('default_profile.png') }}"
                                        alt="Profile" class="w-6 h-6 rounded-full border border-gray-300 object-cover" />
                                
                                    <!-- Nama Pengguna -->
                                    <span class="ml-2 text-gray-800 text-sm font-medium leading-none whitespace-nowrap">
                                        {{ Auth::user()->name }}
                                    </span>
                                </button>
                                

                                    <ul x-show="open" class="absolute origin-top-left w-32 p-4 mt-0 bg-white rounded-lg shadow-sm " x-transition x-cloak href="{{ route('logout') }}">
                                        <!-- jika admin maka ada btn dashboard -->
                                        <a href="{{ route('dashboard') }}" class="relative flex cursor-default select-none hover:bg-neutral-100 items-center rounded px-2 py-1.5 text-sm outline-none transition-colors focus:bg-sky focus:text-accent-foreground data-[disabled]:pointer-events-none data-[disabled]:opacity-50">
                                            Dashboard
                                        </a>
                                        <a href="{{ route('logout') }}" 
                                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();" 
                                                class="relative flex cursor-default select-none hover:bg-neutral-100 items-center rounded px-2 py-1.5 text-sm outline-none transition-colors focus:bg-sky focus:text-accent-foreground data-[disabled]:pointer-events-none data-[disabled]:opacity-50"
                                            >
                                                <span>Log out</span>
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                                            @csrf
                                        </form>
                                    </ul>
                                </div>
                            @endguest
                        </li>
                    </ul>
                    </nav>
                </div>
            </div>
        </div>
</header>