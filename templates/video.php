<?php include __DIR__ . '/header.php'; ?>

<?php if (!$video): ?>
    <div class="max-w-7xl mx-auto px-4 py-12 text-center">
        <h1 class="text-4xl font-bold text-gray-700">Video Not Found</h1>
        <p class="mt-4 text-xl text-gray-500">Sorry, we couldn't load this video right now.</p>
        <a href="/" class="mt-8 inline-block bg-blue-500 text-white px-6 py-3 rounded-full font-bold hover:bg-blue-600 transition">Go Back Home</a>
    </div>
<?php else: ?>
    <?php
    $snippet = $video['snippet'];
    $stats = $video['statistics'] ?? [];
    $player = $video['player']['embedHtml'] ?? '';
    // Enhance iframe to be responsive
    $player = str_replace('width="480"', 'width="100%"', $player);
    $player = str_replace('height="270"', 'height="100%"', $player);
    ?>

    <div class="max-w-5xl mx-auto px-4 py-8">
        <!-- Video Player Container -->
        <div class="bg-black rounded-3xl overflow-hidden shadow-2xl aspect-video relative">
            <!-- We can use the embed HTML from API or manually constuct iframe -->
            <iframe
                class="absolute top-0 left-0 w-full h-full"
                src="https://www.youtube.com/embed/<?= $snippet['resourceId']['videoId'] ?? $id ?>?rel=0&modestbranding=1"
                title="<?= htmlspecialchars($snippet['title']) ?>"
                frameborder="0"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                allowfullscreen>
            </iframe>
        </div>

        <!-- Video Info & CTA -->
        <div class="mt-6 bg-white rounded-2xl p-6 shadow-sm border border-gray-100">
            <h1 class="text-2xl md:text-3xl font-bold text-gray-800 mb-2"><?= htmlspecialchars($snippet['title']) ?></h1>

            <div class="flex flex-col md:flex-row md:items-center justify-between mt-4 gap-4">
                <div class="text-gray-500 font-medium">
                    Published on <?= date('M j, Y', strtotime($snippet['publishedAt'])) ?>
                </div>

                <a href="https://www.youtube.com/watch?v=<?= $id ?>" target="_blank" class="bg-red-600 text-white text-center px-8 py-4 rounded-full text-xl font-bold hover:bg-red-700 hover:scale-105 transform transition duration-300 shadow-lg flex items-center justify-center gap-2">
                    <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M19.615 3.184c-3.604-.246-11.631-.245-15.23 0-3.897.266-4.356 2.62-4.385 8.816.029 6.185.484 8.549 4.385 8.816 3.6.245 11.626.246 15.23 0 3.897-.266 4.356-2.62 4.385-8.816-.029-6.185-.484-8.549-4.385-8.816zm-10.615 12.816v-8l8 3.993-8 4.007z" />
                    </svg>
                    Watch on YouTube
                </a>
            </div>

            <hr class="my-6 border-gray-200">

            <div class="prose max-w-none text-gray-600">
                <p class="whitespace-pre-wrap"><?= nl2br(htmlspecialchars($snippet['description'])) ?></p>
            </div>
        </div>
    </div>
<?php endif; ?>

<?php include __DIR__ . '/footer.php'; ?>