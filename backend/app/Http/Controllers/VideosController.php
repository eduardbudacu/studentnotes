<?php

namespace App\Http\Controllers;

use App\Models\LearningResources\YoutubeVideo;

class VideosController extends Controller {
    public function __construct()
    {
        
    }

    public function show() {
        $webTech05 = YoutubeVideo::createFromUrl('https://youtu.be/Phyb6FeUt3M');
        return $webTech05->embed();
    }
}