<?php include __DIR__ . '/header.php'; ?>

<!-- Hero Section -->
<div class="bg-gradient-to-r from-blue-400 to-purple-500 text-white py-16 text-center">
    <h1 class="text-4xl md:text-6xl font-bold mb-4 drop-shadow-md">Welcome to DeptoKids!</h1>
    <p class="text-xl md:text-2xl opacity-90">Fun and Educational Videos for Everyone</p>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

    <!-- Videos Section -->
    <div class="mb-16">
        <h2 class="text-3xl font-bold text-gray-800 mb-8 border-l-8 border-blue-500 pl-4">Latest Fun Videos</h2>

        <?php if (empty($uploads)): ?>
            <p class="text-center text-gray-500 text-xl py-10">Loading videos from YouTube... (Check API Config)</p>
        <?php else: ?>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                <?php foreach ($uploads as $item): ?>
                    <?php
                    $vidId = $item['snippet']['resourceId']['videoId'];
                    $title = $item['snippet']['title'];
                    $thumb = $item['snippet']['thumbnails']['high']['url'] ?? $item['snippet']['thumbnails']['medium']['url'];
                    ?>
                    <a href="/video?id=<?= $vidId ?>" class="group block bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition transform hover:-translate-y-2 duration-300">
                        <div class="relative aspect-video">
                            <img src="<?= $thumb ?>" alt="<?= htmlspecialchars($title) ?>" class="w-full h-full object-cover">
                            <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-20 transition flex items-center justify-center">
                                <span class="bg-red-600 text-white rounded-full p-3 opacity-0 group-hover:opacity-100 transition transform scale-50 group-hover:scale-100 shadow-xl">
                                    <svg class="w-8 h-8 pl-1" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M8 5v14l11-7z" />
                                    </svg>
                                </span>
                            </div>
                        </div>
                        <div class="p-4">
                            <h3 class="font-bold text-lg text-gray-800 line-clamp-2 group-hover:text-blue-500 transition"><?= htmlspecialchars($title) ?></h3>
                        </div>
                    </a>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>

    <!-- Shorts Section -->
    <div>
        <h2 class="text-3xl font-bold text-gray-800 mb-8 border-l-8 border-pink-500 pl-4">YouTube Shorts</h2>

        <?php if (empty($shorts)): ?>
            <p class="text-center text-gray-500 text-xl py-10">No Shorts found or API Check needed.</p>
        <?php else: ?>
            <div class="flex overflow-x-auto pb-8 space-x-6 px-2 scrollbar-hide" style="-webkit-overflow-scrolling: touch;">
                <?php foreach ($shorts as $item): ?>
                    <?php
                    $vidId = $item['id']['videoId'];
                    $title = $item['snippet']['title'];
                    $thumb = $item['snippet']['thumbnails']['high']['url'] ?? $item['snippet']['thumbnails']['medium']['url'];
                    ?>
                    <a href="/video?id=<?= $vidId ?>" class="flex-none w-48 sm:w-60 group relative bg-black rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition transform hover:scale-105 duration-300">
                        <div class="aspect-[9/16]">
                            <img src="<?= $thumb ?>" alt="<?= htmlspecialchars($title) ?>" class="w-full h-full object-cover opacity-90 group-hover:opacity-100">
                            <div class="absolute inset-0 bg-gradient-to-t from-black via-transparent to-transparent opacity-80"></div>
                            <div class="absolute bottom-0 left-0 p-4">
                                <h3 class="text-white font-bold text-sm line-clamp-2"><?= htmlspecialchars($title) ?></h3>
                            </div>
                            <!-- Shorts Icon Overlay -->
                            <div class="absolute top-2 right-2 bg-red-600 text-white text-xs font-bold px-2 py-1 rounded">Shorts</div>
                        </div>
                    </a>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>

</div>