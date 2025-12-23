<?php

class YouTubeService
{
    private $apiKey;
    private $channelId;
    private $cacheDir;

    public function __construct($apiKey, $channelId)
    {
        $this->apiKey = $apiKey;
        $this->channelId = $channelId;
        $this->cacheDir = __DIR__ . '/../cache/';
        if (!is_dir($this->cacheDir)) {
            mkdir($this->cacheDir, 0777, true);
        }
    }

    private function getCache($key)
    {
        $file = $this->cacheDir . md5($key) . '.json';
        if (file_exists($file) && (time() - filemtime($file) < 3600)) { // 1 hour cache
            return json_decode(file_get_contents($file), true);
        }
        return false;
    }

    private function setCache($key, $data)
    {
        $file = $this->cacheDir . md5($key) . '.json';
        file_put_contents($file, json_encode($data));
    }

    private function request($endpoint, $params = [])
    {
        $params['key'] = $this->apiKey;
        $url = 'https://www.googleapis.com/youtube/v3/' . $endpoint . '?' . http_build_query($params);

        $cached = $this->getCache($url);
        if ($cached) return $cached;

        $response = @file_get_contents($url);
        if ($response) {
            $data = json_decode($response, true);
            $this->setCache($url, $data);
            return $data;
        }

        return null;
    }

    public function getChannelUploads($maxResults = 12)
    {
        // 1. Get Channel's Upload Playlist ID
        $channelData = $this->request('channels', [
            'part' => 'snippet,contentDetails,statistics',
            'forHandle' => "@" . $this->channelId,
        ]);

        if (empty($channelData['items'])) return [];

        $uploadPlaylistId = $channelData['items'][0]['contentDetails']['relatedPlaylists']['uploads'];

        // 2. Get Videos from that playlist
        $playlistItems = $this->request('playlistItems', [
            'playlistId' => $uploadPlaylistId,
            'part' => 'snippet,status',
            'maxResults' => $maxResults
        ]);

        return $playlistItems['items'] ?? [];
    }

    // Note: The YouTube API doesn't have a direct "get shorts" endpoint. 
    // We can simulate this by searching for videos with duration 'short' or just getting general videos 
    // and filtering in UI if needed, but 'videoDuration' filter is only for /search which costs more quota.
    // For now, we will assume Short videos have #shorts in title or description or we fetch a specific playlist if the user has one.
    // Strategy: We will fetch recent videos and let the UI decide, OR search specifically. 
    // Let's use search for now to distinguish specific shorts if possible, but simplest is to just get all videos.
    // OPTIMIZATION: To save quota, we will just fetch the same list or a specific playlist if provided. 
    // Let's implement a search based approach for "Shorts" as it's separate request.
    public function getShorts($maxResults = 12)
    {
        $data = $this->request('search', [
            'channelId' => $this->channelId,
            'part' => 'snippet',
            'maxResults' => $maxResults,
            'order' => 'date',
            'type' => 'video',
            'videoDuration' => 'short' // Less than 4 mins, usually shorts are < 60s
        ]);

        return $data['items'] ?? [];
    }

    public function getVideoDetails($videoId)
    {
        $data = $this->request('videos', [
            'id' => $videoId,
            'part' => 'snippet,player,contentDetails,statistics'
        ]);

        return $data['items'][0] ?? null;
    }
}
