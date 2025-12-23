<?php
// Verification Script

require_once __DIR__ . '/src/Config.php';
require_once __DIR__ . '/src/YouTubeService.php';

echo "1. Checking Classes...\n";
if (class_exists('Config') && class_exists('YouTubeService')) {
    echo "[PASS] Classes loaded.\n";
} else {
    echo "[FAIL] Classes not loaded.\n";
    exit(1);
}

echo "2. Checking Config...\n";
Config::load(__DIR__ . '/.env.example');
if (Config::get('BASE_URL') === 'http://localhost:8000') {
    echo "[PASS] Config loaded.\n";
} else {
    echo "[FAIL] Config load failed.\n";
}

echo "3. Simulation of Home Page Logic...\n";
// Mock data
$uploads = [['snippet' => ['title' => 'Test Video', 'resourceId' => ['videoId' => '123'], 'thumbnails' => ['medium' => ['url' => 'test.jpg']]]]];
$shorts = $uploads;

ob_start();
include __DIR__ . '/templates/home.php';
$html = ob_get_clean();

if (strpos($html, 'DeptoKids') !== false && strpos($html, 'Test Video') !== false) {
    echo "[PASS] Home Page Template Generated.\n";
} else {
    echo "[FAIL] Home Page Template Error.\n";
}

echo "\nVerification Complete. Ready for User Review.\n";
