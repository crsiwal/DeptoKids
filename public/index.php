<?php

// Basic Autoloader
spl_autoload_register(function ($class) {
    include __DIR__ . '/../src/' . $class . '.php';
});

// Load Config
Config::load(__DIR__ . '/../.env');

$apiKey = Config::get('YOUTUBE_API_KEY');
$channelId = Config::get('CHANNEL_ID');

$yt = new YouTubeService($apiKey, $channelId);

// Router Logic
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

if ($path === '/' || $path === '/index.php') {
    // HOME PAGE
    // Fetch Data
    $uploads = $yt->getChannelUploads(12);
    $shorts = $yt->getShorts(10);

    // SEO
    $pageTitle = "Home";
    $pageDesc = "Welcome to DeptoKids! Watch the best fun and educational videos for kids.";

    include __DIR__ . '/../templates/home.php';
} elseif ($path === '/video') {
    // VIDEO PAGE
    $id = $_GET['id'] ?? null;
    $video = null;

    if ($id) {
        $video = $yt->getVideoDetails($id);
    }

    // SEO
    if ($video) {
        $pageTitle = $video['snippet']['title'];
        $pageDesc = substr($video['snippet']['description'], 0, 160);
    } else {
        $pageTitle = "Video Not Found";
        $pageDesc = "The requested video could not be found.";
    }

    include __DIR__ . '/../templates/video.php';
} else {
    // 404
    http_response_code(404);
    echo "404 Not Found";
}
