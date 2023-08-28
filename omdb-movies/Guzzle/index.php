<?php

require 'vendor/autoload.php';

use GuzzleHttp\Client;

$client = new Client();

try {
    $response = $client->request('GET', 'http://www.omdbapi.com', [
        'query' => [
            'apikey' => '8add069',
            's' => 'harry'
        ]
    ]);
    var_dump($response->getBody()->getContents());
} catch (Exception $e) {
    echo "An error occurred: " . $e->getMessage();
}
