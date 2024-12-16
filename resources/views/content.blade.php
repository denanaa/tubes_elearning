<x-layout>

    <section class="w-screen p-10 bg-gradient-to-t from-[#37AFE1]">
      <div class="flex flex-col items-center px-8 w-full leading-6 text-black md:flex-row lg:px-16">
          <!-- Image -->
          <div class="box-border relative w-full max-w-md px-4 mt-5 mb-4 -ml-5 text-center bg-no-repeat bg-contain border-solid md:ml-0 md:mt-0 md:max-w-none lg:mb-0 md:w-1/2 xl:pl-10">
            <img src="{{ asset('images/gambar3.png') }}" alt="Gambar">
            
          </div>
    
          <!-- card -->
          <div class="max-w-7xl py-5 mt-14 mx-auto sm:text-center">
            <div class="grid grid-cols-1 sm:grid-cols-1 lg:grid-cols-1 gap-11 sm:my-4 ">
                  <a href="{{ url('materi') }}">
                    <div class="rounded-[50px] py-10 flex flex-col items-center justify-center shadow-lg border hover:border-sky-700 bg-[#FAF6F2] hover:bg-gray-200 hover:-translate-y-2 transition-transform duration-300 w-96">
                      <div class="rounded-full bg-green-500 p-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16" viewBox="0 0 24 24" fill="none">
                          <path d="M4 4h16a2 2 0 012 2v10a2 2 0 01-2 2H8l-4 4v-4a2 2 0 01-2-2V6a2 2 0 012-2z" fill="#00FF00" />
                          <circle cx="8" cy="10" r="1" fill="white" />
                          <circle cx="12" cy="10" r="1" fill="white" />
                          <circle cx="16" cy="10" r="1" fill="white" />
                        </svg>
                      </div>
                      <h2 class="text-lg font-bold mt-5">Communication Skills</h2>
                        <p class="p-5">
                              Lorem ipsum dolor sit amet consectetur adipisicing elit.
                              Veritatis quibusdam quas repudiandae natus numquam quia voluptatibus,
                              itaque reprehenderit id officiis!</p>
                    </div>
                  </a>
                  <a href="{{ url('materi') }}">
                  <div class="rounded-[50px] py-10 flex flex-col items-center justify-center shadow-lg border hover:border-sky-700 bg-[#FAF6F2] hover:bg-gray-200 hover:-translate-y-2 transition-transform duration-300 w-96">
                    <div class="rounded-full bg-purple-500 p-4">
                      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="white" class="w-12 h-12">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 2a3 3 0 013 3v7a3 3 0 11-6 0V5a3 3 0 013-3zm-7 9v1a7 7 0 0014 0v-1m-7 8v3m-4 0h8" />
                      </svg>
                    </div>
                      <p class="text-lg font-bold mt-5">Pronunciation and Grammar</p>
                      <p class="p-5">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit.
                        Veritatis quibusdam quas repudiandae natus numquam quia voluptatibus,
                        itaque reprehenderit id officiis!</p>
                  </div>
                  </a>
                  <a href="{{ url('materi') }}">
                  <div class="rounded-[50px] py-10 flex flex-col items-center justify-center shadow-lg border hover:border-sky-700 bg-[#FAF6F2] hover:bg-gray-200 hover:-translate-y-2 transition-transform duration-300 w-96">
                    <div class="rounded-full bg-pink-500 p-4">
                      <svg class="w-16 h-auto" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M3 4a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2v16a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4z"></path>
                        <line x1="16" y1="8" x2="8" y2="8"></line>
                        <line x1="16" y1="12" x2="8" y2="12"></line>
                        <line x1="10" y1="16" x2="8" y2="16"></line>
                      </svg>
                    </div>
                      <p class="text-lg font-bold mt-5">Writing and Vocabulary</p>
                      <p class="p-5">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit.
                        Veritatis quibusdam quas repudiandae natus numquam quia voluptatibus,
                        itaque reprehenderit id officiis!</p>
                  </div>
                  </a>
            </div>
          </div> 
      </div>
    </section>
    
    </x-layout>
    
    