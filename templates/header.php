<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($pageTitle) ? $pageTitle . ' - DeptoKids' : 'DeptoKids - Fun Learning for Kids' ?></title>
    <meta name="description" content="<?= isset($pageDesc) ? $pageDesc : 'Watch the best fun and educational videos for kids on DeptoKids!' ?>">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@300;400;600&display=swap" rel="stylesheet">

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <style>
        body {
            font-family: 'Fredoka', sans-serif;
        }

        .aspect-video {
            aspect-ratio: 16 / 9;
        }
    </style>
</head>

<body class="bg-blue-50 text-gray-800">

    <nav class="bg-white shadow-md sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <a href="/" class="flex-shrink-0 flex items-center">
                        <!-- Placeholder Logo matching brand colors -->
                        <span class="text-3xl font-bold text-pink-500">Depto</span>
                        <span class="text-3xl font-bold text-blue-500">Kids</span>
                    </a>
                </div>
                <div class="flex items-center space-x-4">
                    <a href="/" class="text-gray-700 hover:text-pink-500 px-3 py-2 rounded-md text-lg font-medium">Home</a>
                    <a href="https://www.youtube.com/@DeptoKids" target="_blank" class="bg-red-600 text-white px-4 py-2 rounded-full hover:bg-red-700 transition duration-300 font-bold">
                        YouTube Channel
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <main class="min-h-screen">