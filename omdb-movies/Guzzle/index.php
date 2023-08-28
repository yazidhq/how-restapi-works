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
    $result = json_decode($response->getBody()->getContents(), true);
} catch (Exception $e) {
    echo "An error occurred: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movie</title>
</head>

<body>

    <?php foreach ($result['Search'] as $row) : ?>
        <ul>
            <li>Title : <?= $row['Title'] ?></li>
            <li>Year : <?= $row['Year'] ?></li>
            <li>
                <img src="<?= $row['Poster'] ?>" alt="">
            </li>
        </ul>
    <?php endforeach; ?>

</body>

</html>