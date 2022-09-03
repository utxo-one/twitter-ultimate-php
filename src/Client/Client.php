<?php

namespace UtxoOne\TwitterUltimatePhp\Client;

use UtxoOne\TwitterUltimatePhp\Models\TwitterResponse;

class Client
{
    private $apiKey;
    private $apiSecret;
    private $accessKey;
    private $accessSecret;
    private $baseUrl;
    private $bearerToken;
    private \GuzzleHttp\Client $client;
    public $userFields;
    public $tweetFields;
    public $mediaFields;
    public $placeFields;
    public $pollFields;
    public $listFields;
    public $expansions;
     
    public function __construct(
        ?string $apiKey = null,
        ?string $apiSecret = null,
        ?string $accessKey = null,
        ?string $accessSecret = null,
        ?string $bearerToken = null,
    ) {
        $this->apiKey = $apiKey;
        $this->apiSecret = $apiSecret;
        $this->accessKey = $accessKey;
        $this->accessSecret = $accessSecret;
        $this->baseUrl = 'https://api.twitter.com/2/';
        $this->bearerToken = $bearerToken;
        $this->client = $client = new \GuzzleHttp\Client();
        $this->listFields = 'created_at,follower_count,member_count,private,description,owner_id';
        $this->userFields = 'created_at,description,entities,id,location,name,pinned_tweet_id,profile_image_url,protected,public_metrics,url,username,verified,withheld';
        $this->tweetFields = 'attachments,author_id,context_annotations,conversation_id,created_at,entities,geo,id,in_reply_to_user_id,lang,possibly_sensitive,public_metrics,referenced_tweets,reply_settings,source,text,withheld';
    }

    public function get(string $endpoint, ?array $params = null): TwitterResponse 
    {
        try {
            $response = $this->client->request('GET', $this->baseUrl . $endpoint, [
                'headers' => [
                    'Authorization' => 'Bearer ' . $this->bearerToken,
                    'Accept' => 'application/json',
                ],
                'query' => $params,
            ]);
        } catch (\GuzzleHttp\Exception\GuzzleException $e) {
            throw new \Exception($e->getMessage());
        }

        if ($response->getStatusCode() !== 200) {
            throw new \Exception('Twitter API returned status code ' . $response->getStatusCode());
        }

        $body = json_decode($response->getBody(), true);

        if (isset($body['errors'])) {
            throw new \Exception($body['errors'][0]['detail']);
        }
    
        return new TwitterResponse($response);
    }
}
