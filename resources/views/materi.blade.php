<x-layout>
<section class="w-screen p-10 bg-gradient-to-t from-[#37AFE1]">
    <div class="flex flex-col items-center px-8 w-full leading-6 text-black lg:px-16">
        {{-- Judul --}}
        <div class="px-10 py-10 max-w-7xl text-center">
            <h1 class="mb-6 mt-14 text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-extrabold leading-none max-w-6xl tracking-normal text-gray-900 md:tracking-tight">
                Your <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 via-pink-400 to-red-500">Journey to Knowledge</span>
                <br class="lg:block hidden">Starts Here
            </h1>
        </div>

        {{-- Search Section --}}
        <div class="container mx-auto p-2 bg-white rounded-xl mt-8"> 
            <div class="w-full max-w-6xl px-4 flex items-center space-x-4">
                <div class="form-control w-full py-10">
                    <form action="" method="GET" class="flex">
                        <div class="relative flex-grow">
                            <input type="text" name="query" placeholder="Start your search here..." class="input input-bordered w-full focus:outline-none bg-[#B3E5FC] text-black pl-10" />
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-grey">Search</button>
                    </form>
                </div>

                {{-- Modul Dropdown --}}
                <label class="form-control max-w-xs mb-6">
                    <span class="label-text font-semibold text-base">Modul</span>
                    <select class="select select-bordered select-primary max-w-xs overflow-y-auto max-h-24" onchange="filterVideos(this.value)">
                      <option disabled selected>Choose Type</option>
                      @foreach ($modules as $module)
                          <option value="{{ $module->id_module }}" data-category="{{ $module->id_category }}">{{ $module->name_module }}</option>
                      @endforeach
                  </select>
                </label>

                {{-- Reset Button --}}
                <button class="btn btn-primary bg-[#4DA8DA] text-white hover:bg-[#2E91C2] transition-all hover:scale-105 shadow-md" onclick="resetDropdown()">
                    Reset Filter
                </button>
            </div> 
        </div>

        {{-- Video Cards Section --}}
        <section class="container mx-auto p-10 py-20">
            {{-- card --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-11">
                @foreach ($videos as $video)
                    @component('components.cardslide', ['video' => $video])
                    @endcomponent
                @endforeach
            </div>
        </section>
    
        {{-- Pagination --}}
          <div class="flex justify-center mt-4 p-24">
            <div class="flex items-center justify-center w-full h-16 px-3">
              <nav>
                  <ul class="flex items-center text-sm leading-tight bg-white border border-neutral-200/70 rounded h-[34px] text-neutral-500">
                      @if ($videos->onFirstPage())
                          <li class="h-full">
                              <span class="py-2 relative inline-flex items-center h-full px-3 rounded-l group text-gray-400">
                                  Previous
                              </span>
                          </li>
                      @else
                          <li class="h-full">
                              <a href="{{ $videos->previousPageUrl() }}" class="py-2 relative inline-flex items-center h-full px-3 rounded-l group hover:bg-[#4DA8DA] hover:text-white">
                                  Previous
                              </a>
                          </li>
                      @endif

                      @foreach ($videos->getUrlRange(1, $videos->lastPage()) as $page => $url)
                          @if ($page == $videos->currentPage())
                              <li class="hidden h-full md:block">
                                  <span class="relative inline-flex items-center h-full px-3 bg-[#4DA8DA] text-white">
                                      {{ $page }}
                                  </span>
                              </li>
                          @else
                              <li class="hidden h-full md:block">
                                  <a href="{{ $url }}" class="relative inline-flex items-center h-full px-3 group hover:bg-[#4DA8DA] hover:text-white">
                                      {{ $page }}
                                  </a>
                              </li>
                          @endif
                      @endforeach

                      @if ($videos->hasMorePages())
                          <li class="h-full">
                              <a href="{{ $videos->nextPageUrl() }}" class="relative inline-flex items-center h-full px-3 rounded-r group hover:bg-[#4DA8DA] hover:text-white">
                                  Next
                              </a>
                          </li>
                      @else
                          <li class="h-full">
                              <span class="py-2 relative inline-flex items-center h-full px-3 rounded-r group text-gray-400">
                                  Next
                              </span>
                          </li>
                      @endif
                  </ul>
              </nav>
            </div>
          </div>
    </div>
</section>

</x-layout>

<script>
    function filterVideos(moduleId) {
    var categoryId = document.querySelector('option[value="'+moduleId+'"]').getAttribute('data-category');
    window.location.href = "{{ url('materi/filter') }}?id_module=" + moduleId + "&id_category=" + categoryId;
}

function resetDropdown() {
    window.location.href = "{{ url('materi') }}";
}

</script>
