<?php

class DogApp {
    private $api;

    public function __construct($api) {
        $this->api = $api;
}

    public function showDogImages() {
        $images = $this->api->fetchImages(10);
        echo "<main>";
        foreach ($images as $img) {
            echo "<div class='dog-card'><img src='{$img['url']}' alt='Dog'></div>";
        }
        echo "</main>";
    }
}
