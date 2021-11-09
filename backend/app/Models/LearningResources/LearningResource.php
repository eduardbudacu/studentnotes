<?php
namespace App\Models\LearningResources;

class LearningResource {
    protected $title;
    protected $reference;

    public function setReference($reference) {
        $this->reference = $reference;
    }

    /**
     * Performs a http request to determine the final url of a resource
     */
    protected static function getFinalUrl($url) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);

        $html = curl_exec($ch);

        $redirectedUrl = curl_getinfo($ch, CURLINFO_EFFECTIVE_URL);

        curl_close($ch);

        return $redirectedUrl;
    }

    public static function getAllResources() {
        return [
            Book::class,
            Document::class,
            YoutubeVideo::class,
            Documents\Pdf::class
        ];
    }
}