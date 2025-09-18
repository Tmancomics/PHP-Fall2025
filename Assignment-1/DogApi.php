<?php

class DogApi
{
    private $baseUrl;
    private $apiKey;

    public function __construct($baseUrl, $apiKey)
    {
        $this->baseUrl = $baseUrl;
        $this->apiKey = $apiKey;
    }

    public function fetchImages($limit = 10)
    {
        $url = $this->baseUrl . "?limit=$limit";
        $options = [
            'http' => [
                'header' => "x-api-key: " . $this->apiKey
            ]
        ];
        $context = stream_context_create($options);
        $response = file_get_contents($url, false, $context);
        return json_decode($response, true);
    }
}
