<?php

class DogApp {
    private $api;

    public function __construct($api) {
        $this->api = $api;
}

    public function showDogImages() {
        $images = $this->api->fetchImages(12);
        echo "<main>";
        foreach ($images as $img) {
            echo "<div class='dogimage'><img src='{$img['url']}' alt='Dog'></div>";
        }
        echo "</main>";
    }
}
