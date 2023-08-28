<?php

require 'vendor/autoload.php';

use GuzzleHttp\Client;

$client = new Client();

$response = $client->request('GET', 'http://www.omdbapi.com', [
    'query' => [
        'apiKey' => '8add069',
        's' => 'harry'
    ]
]);

var_dump($response);
