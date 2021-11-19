<?php

namespace App\Models\LearningResources;

use Google\Client as Google_Client;
use Google\Service\YouTube as YouTube;


class YoutubeVideo extends LearningResource {
    protected $videoId;

    public static function createFromUrl($url) {
        $obj = new self();
        $url = self::getFinalUrl($url);
        $obj->setReference($url);
        $obj->extractVideoId();
        $obj->getVideoDetails();
        return $obj;
    }

    /**
     * Loads video details from YouTube API
     */
    protected function getVideoDetails() {
        $client = new Google_Client();
        $client->setDeveloperKey(env('GOOGLE_CLOUD_API_KEY'));

        $youtube = new YouTube($client);
        $videoResponse = $youtube->videos->listVideos('snippet', array(
            'id' => $this->videoId
        ));

        $this->title = $videoResponse['items'][0]['snippet']['title'];
    }

    /**
     * Parses the final url of a video and saves the video id
     */
    protected function extractVideoId() {
        $urlParts = parse_url($this->reference);
        parse_str($urlParts['query'], $queryParams);
        if(isset($queryParams['v'])) {
            $this->videoId = $queryParams['v'];
        }
    }

    /**
     * Returns the html iframe code for embeding a video
     */
    public function embed() {
        return <<<HOD
        <iframe width="560" height="315" src="https://www.youtube-nocookie.com/embed/{$this->videoId}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
HOD;
    }
}