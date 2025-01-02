<x-layout>

    <section class="w-screen p-10 bg-gradient-to-t from-[#37AFE1]">
      <div class="flex flex-col items-center px-8 w-full leading-6 text-black md:flex-row lg:px-16">
          <!-- Image -->
          <div class="box-border relative w-full max-w-md px-4 mt-5 mb-4 -ml-5 text-center bg-no-repeat bg-contain border-solid md:ml-0 md:mt-0 md:max-w-none lg:mb-0 md:w-1/2 xl:pl-10">
            <img src="{{ asset('images/gambar3.png') }}" alt="Gambar">
            
          </div>
    
          <!-- card -->
          <div class="max-w-7xl py-5 mt-14 mx-auto sm:text-center">
          @foreach ($categories as $category)
            <div class="grid grid-cols-1 sm:grid-cols-1 lg:grid-cols-1 gap-11 sm:my-4 ">
            <a href="{{ route('materi.kategori', ['categoryId' => $category->id_category]) }}">
                    <div class="rounded-[50px] py-10 flex flex-col items-center justify-center shadow-lg border hover:border-sky-700 bg-[#FAF6F2] hover:bg-gray-200 hover:-translate-y-2 transition-transform duration-300 w-96">
                    <img src="{{ asset($category->image) }}" alt="{{ $category->name }}" class="h-32 w-32 object-cover rounded-full">
                      <h2 class="text-lg font-bold mt-5">{{ $category->name }}</h2>
                        <p class="p-5">
                        {{ $category->description }}</p>
                    </div>
                  </a>        
            </div>
            @endforeach 
          </div>
      </div>
    </section>
    
    </x-layout>
    
    