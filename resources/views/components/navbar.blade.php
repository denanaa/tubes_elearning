<div class="w-full">
    <div class="flex items-center justify-between w-full relative">
            <!-- Logo -->
            <div class="px-4">
                <a href="#home" class="font-bold italic text-lg text-[#37AFE1] block py-6">BinaBahasa</a>
            </div>

            <!-- Navigasi dan Tombol -->
            <div class="flex items-center px-4">
                <!-- Tombol Login (khusus layar kecil, di luar hamburger) -->
                <a 
                    href="{{ route('login') }}" 
                    class="text-base font-semibold text-white bg-[#37AFE1] py-2 px-6 rounded-lg hover:bg-[#4CC9FE] transition duration-300 ease-in-out mr-8 lg:hidden"
                >
                    Login
                </a>

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
                    class="absolute py-5 bg-[#FAF6F2] shadow-lg rounded-lg max-w-[250px] w-full right-4 top-full lg:block lg:static lg:bg-transparent lg:max-w-full lg:shadow-none lg:rounded-none"
                >
                    <ul class="block lg:flex lg:items-center lg:gap-8">
                        <li class="group">
                            <a href="#home" class="text-base font-semibold text-black py-2 mx-8 flex group-hover:text-[#37AFE1]" :class="{ 'text-blue-500 border-b-2 border-blue-500': activePage === 'home' }"
                            @click="activePage = 'home'">Home</a>
                        </li>   
                        <li class="group">
                            <a href="#content" class="text-base font-semibold text-black py-2 mx-8 flex group-hover:text-[#37AFE1]">Content</a>
                        </li>
                        <li class="group hidden lg:block">
                            <a 
                                href="{{ route('login') }}" 
                                class="text-base font-semibold text-white bg-[#37AFE1] py-2 px-6 rounded-lg flex hover:bg-gray-400 hover:text-black transition duration-300 ease-in-out"
                            >
                                Login
                            </a>
                        </li>
                    </ul>
                    </nav>
                </div>
            </div>
        </div>
</header>