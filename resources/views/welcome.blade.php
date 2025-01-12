<?php
$channels = [
    'UCTvMDjmhpuYU8Wfvf54Fzvw', // Channel ID 1
    'UCKgpamMlm872zkGDcBJHYDg', // Channel ID 2
    'UCLsI5-B3rIr27hmKqE8hi4w', // Channel ID 3
];

$apiKey = config('services.youtube.key');
$channelData = [];

foreach ($channels as $channelId) {
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, "https://www.googleapis.com/youtube/v3/channels?part=snippet,statistics&id=$channelId&key=$apiKey");
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $result = curl_exec($curl);
    curl_close($curl);

    $result = json_decode($result, true);

    if (!empty($result['items'])) {
        $channelItem = $result['items'][0];
        $customUrl = isset($channelItem['snippet']['customUrl'])
            ? "https://www.youtube.com/@" . $channelItem['snippet']['customUrl']
            : "https://www.youtube.com/channel/" . $channelId;

        $channelData[] = [
            'profilePic' => $channelItem['snippet']['thumbnails']['medium']['url'],
            'channelName' => $channelItem['snippet']['title'],
            'subscriber' => $channelItem['statistics']['subscriberCount'],
            'url' => $customUrl,
        ];
    }
}

?>

<x-layout>

    <!-- Hero Section Start -->
    <section id="home" class="pt-36 w-full h-screen flex items-center">
    <div class="w-full px-4 sm:px-6 lg:px-8">
            {{-- Div Kiri --}}
            <div class="flex flex-wrap">
                <div class="w-full self-center px-4 lg:w-1/2">
                    <h1 class="font-semibold text-4xl lg:text-7xl">Siap Belajar</h1>
                    <h1 class="font-semibold text-4xl text-[#37AFE1] mb-10 lg:text-7xl">Bahasa Inggris?</h1>
                    <p class="font-medium text-justify text-black/50 text-lg lg:text-left mb-8 leading-relaxed">Bersama BinaBahasa, belajar bahasa Inggris jadi lebih mudah dan menyenangkan. Klik tombol di bawah untuk mulai meningkatkan kemampuan Anda sekarang juga!</p>
                    <a href="{{ url('content') }}" class="text-base font-semibold text-white bg-[#37AFE1] py-3 px-8 rounded-xl hover:bg-[#4CC9FE] transition duration-300 ease-in-out">Belajar Sekarang</a>
                </div>
                {{-- Div Kanan --}}
                <div class="w-full self-end px-4 lg:w-1/2 text-right">
                    <div class="relative mt-10 lg:mt-0 lg:right-0">
                        <img src="{{ asset('images/gambar1.png') }}" alt="" class="max-w-full inline-block" />
                    </div>
                </div>
            </div>
        </div>
    </section>
<!-- Hero Section End -->

<!-- About Section Start -->
    <section id="about" class="pt-36 pb-32 bg-[#37AFE1] rounded-[50px] p-8 w-full">
    <div class="w-full px-4 sm:px-6 lg:px-8">
            <div class="flex flex-wrap items-center">
                <div class="w-full px-4 mb-10 lg:w-1/2">
                    <h1 class="block font-semibold text-4xl lg:text-5xl lg:mb-0">
                        Mengenal <span class="text-[#F5F4B3] italic">BinaBahasa</span>
                    </h1>
                </div>
                <div class="w-full px-4 lg:w-1/2">
                    <p class="font-medium text-justify text-white text-lg mb-8 leading-relaxed">BinaBahasa adalah platform e-learning yang dirancang untuk membantu Anda belajar dan menguasai bahasa Inggris 
                        dengan mudah dan menyenangkan. Dengan materi yang terstruktur, latihan interaktif, dan pendekatan pembelajaran
                        praktis, BinaBahasa mendukung Anda untuk meningkatkan keterampilan berbahasa Inggris, baik untuk kebutuhan akademik, 
                        profesional, maupun komunikasi sehari-hari. Mari bina kemampuan bahasa Anda bersama kami dan raih peluang tanpa batas di masa depan!
                    </p>
                </div>
            </div>
        </div>
    </section>
<!-- About Section End -->

<!-- Reason Section Start -->
<section id="reason" class="pt-36 pb-32 w-full">
<div class="w-full px-4 sm:px-6 lg:px-8">
        <!-- Title Section -->
        <div class="w-full px-4 text-center mb-16">
            <h1 class="font-bold text-black text-4xl mb-4">Alasan Belajar Bahasa Inggris</h1>
            <p class="font-medium text-md text-black/50">
                Bahasa Inggris membuka pintu menuju dunia yang lebih luas. Temukan peluang tak terbatas dengan menguasainya!
            </p>
        </div>

        <!-- Reasons Section -->
        <div class="w-full px-4 flex flex-wrap justify-between gap-y-8 mt-12">
            <!-- Reason Item -->
            <div class="flex items-start  gap-4 w-full md:w-1/2 mt-6">
                <div class="w-2 h-full bg-[#37AFE1] rounded-lg"></div>
                <div>
                    <h3 class="font-semibold text-xl text-black mb-3">
                        Meningkatkan Peluang Karir
                    </h3>
                    <p class="font-medium text-base text-black/50">
                        Menguasai bahasa Inggris membuka banyak peluang karir di dunia global, baik untuk pekerjaan internasional maupun perusahaan lokal.
                    </p>
                </div>
            </div>
            <div class="flex items-start gap-4 w-full md:w-1/2 mt-6">
                <div class="w-2 h-full bg-[#37AFE1] rounded-lg"></div>
                <div>
                    <h3 class="font-semibold text-xl text-black mb-3">
                        Menikmati Hiburan Global
                    </h3>
                    <p class="font-medium text-base text-black/50">
                        Film, musik, dan buku-buku populer sering kali menggunakan bahasa Inggris. Menguasainya memungkinkan Anda menikmati hiburan tanpa batasan.
                    </p>
                </div>
            </div>
            <div class="flex items-start gap-4 w-full md:w-1/2 mt-6">
                <div class="w-2 h-full bg-[#37AFE1] rounded-lg"></div>
                <div>
                    <h3 class="font-semibold text-xl text-black mb-3">
                        Mempermudah Komunikasi Global
                    </h3>
                    <p class="font-medium text-base text-black/50">
                        Menguasai bahasa Inggris membuka banyak peluang karir di dunia global, baik untuk pekerjaan internasional maupun perusahaan lokal.
                    </p>
                </div>
            </div>
            <div class="flex items-start gap-4 w-full md:w-1/2 mt-6">
                <div class="w-2 h-full bg-[#37AFE1] rounded-lg"></div>
                <div>
                    <h3 class="font-semibold text-xl text-black mb-3">
                        Akses ke Pengetahuan dan Sumber Belajar
                    </h3>
                    <p class="font-medium text-base  text-black/50">
                        Sebagian besar materi pembelajaran, riset, dan buku-buku penting ditulis dalam bahasa Inggris. Menguasainya memberi Anda akses ke informasi global.
                    </p>
                </div>
            </div>
            <div class="flex items-start gap-4 w-full md:w-1/2 mt-6">
                <div class="w-2 h-full bg-[#37AFE1] rounded-lg"></div>
                <div>
                    <h3 class="font-semibold text-xl text-black mb-3">
                        Mengasah Keterampilan Kognitif
                    </h3>
                    <p class="font-medium text-base text-black/50">
                        Belajar bahasa baru seperti bahasa Inggris dapat membantu meningkatkan kemampuan otak dalam berpikir kritis, memecahkan masalah, dan meningkatkan daya ingat.
                    </p>
                </div>
            </div>
            
            <div class="flex items-start gap-4 w-full md:w-1/2 mt-6">
                <div class="w-2 h-full bg-[#37AFE1] rounded-lg"></div>
                <div>
                    <h3 class="font-semibold text-xl text-black mb-3">
                        Meningkatkan Percakapan Sehari-hari
                    </h3>
                    <p class="font-medium text-base text-black/50">
                        Belajar bahasa Inggris membantu Anda berinteraksi dengan lebih percaya diri dalam kehidupan sehari-hari, baik saat bepergian maupun berkomunikasi dengan teman internasional.
                    </p>
                </div>
            </div>
            
        </div>
    </div>
</section>
<!-- Reason Section End -->

<!-- Youtube Channel Section Start -->
<section id="reason" class="pt-20 pb-32 w-full bg-gradient-to-t from-[#37AFE1]">
<div class="w-full px-4 text-center mb-16">
            <h1 class="font-bold text-black text-4xl mb-4">Youtube Channel Pembelajaran Bahasa Inggris</h1>
</div>
<div class="jumbotron" id="home" style="padding: 2rem;">
    <div class="container">
        <div style="display: flex; justify-content: center; gap: 2rem;">
            <?php foreach ($channelData as $channel): ?>
                <div style="display: flex; align-items: center; max-width: 100%; margin-bottom: 1rem; gap: 1rem; padding: 1rem;">
                    <!-- Gambar -->
                    <img src="<?= $channel['profilePic']; ?>" alt="Profile Picture"
                         style="width: 100px; height: 100px; border-radius: 50%; object-fit: cover;">
                    <!-- Teks -->
                    <div>
                        <h1 style="font-size: 1.5rem; margin: 0;"><?= $channel['channelName']; ?></h1>
                        <h3 style="font-size: 1rem; margin: 0; color: #666;"><?= number_format($channel['subscriber']); ?> Subscribers</h3>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
</section>
<!-- Youtube Channel Section End -->

<!-- Ayo Section Start -->
<section id="about" class="pt-36 pb-32 bg-[#37AFE1] w-full">
<div class="w-full px-4 sm:px-6 lg:px-8">
        <div class="flex flex-wrap items-center text-center mx-auto">
            <div class="w-full px-8 mb-10 lg:w-1/2 lg:right-0">
                <h1 class="block font-semibold text-4xl text-white lg:text-5xl lg:text-right lg:mb-0">
                    Ayo, Tingkatkan Bahasa Inggris Kamu Sekarang!
                </h1>
            </div>
            <div class="w-full px-8 lg:w-1/2 lg:text-center lg:pl-5">
                <a href="{{ url('content') }}" class="text-base font-semibold text-[#37AFE1] bg-white py-3 px-8 rounded-xl hover:text-white hover:bg-[#4CC9FE] transition duration-300 ease-in-out">Belajar Sekarang</a>
            </div>
        </div>
    </div>
</section>
<!-- Ayo Section End -->


            </x-layout>
