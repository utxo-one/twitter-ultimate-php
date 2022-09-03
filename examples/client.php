<?php

use UtxoOne\TwitterUltimatePhp\Client\Client;

require './vendor/autoload.php';

$client = new Client();

$response = $client->get('tweets/search/recent', [
    'query' => 'from:twitterdev',
    'tweet.fields' => 'author_id',
]);

print_r($response);

