<x-layout>
<section class="w-full p-10 bg-gradient-to-t from-[#37AFE1]" data-category-id="{{ $categoryId }}">
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
                        <form action="{{ route('materi.search') }}" method="GET" class="flex">
                            <div class="relative flex-grow">
                                <input
                                    type="text"
                                    id="searchInput"
                                    name="query"
                                    placeholder="Start your search here..."
                                    class="input input-bordered w-full focus:outline-none bg-[#B3E5FC] text-black pl-10"
                                />
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
                    <select class="select select-bordered select-primary max-w-xs overflow-y-auto max-h-24" name="category" onchange="filterVideos(this.value)" 
                    data-category-id="{{ $categoryId }}">
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
            <div class="video-container grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-11">
                @foreach ($videos as $video)
                    @component('components.cardslide', ['video' => $video])
                    @endcomponent
                @endforeach
            </div>
        </section>

    
        {{-- Pagination --}}
        <div class="pagination-container flex justify-center mt-4 p-24">
            <div class="flex items-center justify-center w-full h-16 px-3">
                <nav>
                    <ul class="pagination flex items-center text-sm leading-tight bg-white border border-neutral-200/70 rounded h-[34px] text-neutral-500">
                        @if ($videos->isEmpty())
                            <p class="text-center text-gray-500">Tidak ada video yang ditemukan.</p>
                        @endif

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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
function filterVideos(moduleId) {
    const categoryId = document.querySelector('select[name="category"]').dataset.categoryId;

    fetch(`/materi/filter?id_module=${moduleId}&id_category=${categoryId}`)
        .then(response => response.json())
        .then(data => {
            const videoContainer = document.querySelector('.video-container');
            videoContainer.innerHTML = ''; // Kosongkan kontainer video

            // Cek apakah data ada dan merupakan array
            const videos = data.data || []; // Gunakan data.data untuk paginasi
           
            if (data.length === 0) {
                videoContainer.innerHTML = '<p>No videos found.</p>';
                return;
            }

            videos.forEach(video => {
                const videoCard = `
                    <a href="/video/${video.id_video}" class="block">
                        <div class="card w-full sm:w-80 lg:w-96 bg-white shadow-lg rounded-xl hover:shadow-2xl transform hover:-translate-y-2 transition-all duration-300 border hover:border-[#2E91C2]">
                            <figure class="aspect-video">
                                <img src="/storage/${video.thumbnail_video}" alt="${video.title_video}" class="w-full h-full object-cover hover:scale-105 transition-transform duration-300" />
                            </figure>
                            <div class="card-body text-left p-4">
                                <h2 class="text-lg font-bold text-gray-800">${video.title_video}</h2>
                                <p class="text-gray-600">${video.description_video}</p>
                                <p class="text-right text-blue-600">${video.module_name}</p>
                            </div>
                        </div>
                    </a>
                `;
                videoContainer.innerHTML += videoCard; // Tambahkan video ke kontainer
            });

            // Update pagination
            updatePagination(data.links, moduleId);
        })
        .catch(error => console.error('Error fetching videos:', error));
}

function updatePagination(links, moduleId) {
    const paginationContainer = document.querySelector('.pagination');
    paginationContainer.innerHTML = '';

    links.forEach(link => {
        const isActive = link.active ? 'bg-[#4DA8DA] text-white' : 'hover:bg-[#4DA8DA] hover:text-white';
        const button = 
        `
            <a href="#" onclick="filterVideos(${moduleId}, ${link.page}); return false;"
                class="relative inline-flex items-center h-full px-3 group ${isActive}">
                ${link.label}
            </a>`;
        paginationContainer.innerHTML += button;
    });
}

function resetDropdown() {
    const categoryId = document.querySelector('select[name="category"]').dataset.categoryId; // Ambil ID kategori aktif

    // Redirect ke URL kategori yang benar
    if (categoryId) {
        window.location.href = `/materi/kategori/${categoryId}`;
    } else {
        window.location.href = '/materi'; // Jika tidak ada kategori, kembali ke semua data
    }
}

// Autocomplete search
$(document).ready(function () {
    const searchInput = $('#searchInput');
    const moduleFilter = $('select[name="category"]') || '';
    const videoContainer = $('.video-container'); // Kontainer untuk video yang sudah ada
    const categoryId = $('section[data-category-id]').data('categoryId') || '';

    // Fungsi untuk memuat video berdasarkan query atau filter modul
    function loadVideos(query = '', moduleId = '', categoryId = '', page = 1) {
        $.ajax({
            url: "{{ route('materi.search') }}", // Route pencarian
            method: 'GET',
            data: {
                query: query || '',  // Pastikan query tidak kosong
                id_module: moduleId || '',
                id_category: categoryId || '',
                page: page || 1,  // Pastikan categoryId dikirimkan
            },
            success: function (response) {
                if (response.videos.length === 0) {
                    $('.video-container').html('<p>No videos found.</p>');
                    return;
                }
                renderVideos(response.videos);
                updatePaginationSearch(response.pagination);
            },
            error: function () {
                $('.video-container').html('<p>Error fetching results.</p>');
            }
        });
    }

    function renderVideos(data) {
        const videoContainer = $('.video-container');
        videoContainer.empty();
        data.forEach(video => {
            const videoCard = `
                <a href="/video/${video.id_video}" class="block">
                    <div class="card w-full sm:w-80 lg:w-96 bg-white shadow-lg rounded-xl hover:shadow-2xl transform hover:-translate-y-2 transition-all duration-300 border hover:border-[#2E91C2]">
                        <figure class="aspect-video">
                            <img src="/storage/${video.thumbnail_video}" alt="${video.title_video}" class="w-full h-full object-cover hover:scale-105 transition-transform duration-300" />
                        </figure>
                        <div class="card-body text-left p-4">
                            <h2 class="text-lg font-bold text-gray-800">${video.title_video}</h2>
                            <p class="text-gray-600">${video.description_video}</p>
                            <p class="text-right text-blue-600">${video.module_name}</p>
                        </div>
                    </div>
                </a>`;
            videoContainer.append(videoCard);
        });
    }
    
    function updatePaginationSearch(pagination) {
        const paginationContainer = $('.pagination'); 
        paginationContainer.empty(); 

        // Previous Button
        if (pagination.prev_page_url) {
            paginationContainer.append(`
                <a href="#" onclick="loadVideos('${$('#searchInput').val()}', '${$('select[name="category"]').val()}', '${$('section[data-category-id]').data('categoryId')}', ${pagination.current_page - 1}); return false;"
                    class="relative inline-flex items-center h-full px-3 group hover:bg-[#4DA8DA] hover:text-white">
                    Previous
                </a>`);
        }

        // Page Numbers
        for (let page = 1; page <= pagination.last_page; page++) {
            const isActive = page === pagination.current_page ? 'bg-[#4DA8DA] text-white' : 'hover:bg-[#4DA8DA] hover:text-white';
            paginationContainer.append(`
                <a href="#" onclick="loadVideos('${$('#searchInput').val()}', '${$('select[name="category"]').val()}', '${$('section[data-category-id]').data('categoryId')}', ${page}); return false;"
                    class="relative inline-flex items-center h-full px-3 group ${isActive}">
                    ${page}
                </a>`);
        }

        // Next Button
        if (pagination.next_page_url) {
            paginationContainer.append(`
                <a href="#" onclick="loadVideos('${$('#searchInput').val()}', '${$('select[name="category"]').val()}', '${$('section[data-category-id]').data('categoryId')}', ${pagination.current_page + 1}); return false;"
                    class="relative inline-flex items-center h-full px-3 group hover:bg-[#4DA8DA] hover:text-white">
                    Next
                </a>`);
        }
    }

        searchInput.on('input', function () {
            const query = $(this).val() || '';
            const moduleId = moduleFilter.val() || '';
            const categoryId = $('section[data-category-id]').data('categoryId') || ''; // Pastikan categoryId dikirimkan
            loadVideos(query, moduleId, categoryId,1);  // Pastikan kategori ID dikirim
        });

        moduleFilter.on('change', function () {
            const query = searchInput.val() || '';
            const moduleId = $(this).val() || '';
            const categoryId = $('section[data-category-id]').data('categoryId') || ''; // Pastikan categoryId dikirimkan
            loadVideos(query, moduleId, categoryId,1);  // Pastikan kategori ID dikirim
        });

});



</script>