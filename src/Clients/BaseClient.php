<?php

namespace UtxoOne\TwitterUltimatePhp\Clients;

use UtxoOne\TwitterUltimatePhp\Models\TwitterResponse;
use Abraham\TwitterOAuth\TwitterOAuth;
use Exception;
use UtxoOne\TwitterUltimatePhp\Models\TwitterPostResponse;

class BaseClient
{
    /**
     * Twitter Developer API Key
     *
     * @var string
     */
    private $apiKey;

    /**
     * Twitter Developer API Secret
     *
     * @var string
     */
    private $apiSecret;

    /**
     * Twitter User OAuth Access Key
     *
     * @var string
     */
    private $accessKey;

    /**
     * Twitter User OAuth Access Secret
     *
     * @var string
     */
    private $accessSecret;

    /**
     * Twitter Project Client ID
     *
     * @var string
     */
    private $clientId;

    /**
     * Twitter Project Client Secret
     *
     * @var string
     */
    private $clientSecret;

    /**
     * Twitter API Base URL
     *
     * @var string
     */
    private $baseUrl;

    /**
     * Twitter Developer Bearer Token
     *
     * @var string
     */
    private $bearerToken;

    /**
     * Guzzle Client
     *
     * @var \GuzzleHttp\Client
     */
    private \GuzzleHttp\Client $client;

    /**
     * Twitter User Fields (comma delimited)
     *
     * @var string
     */
    public $userFields;

    /**
     * Twitter Tweet Fields (comma delimited)
     *
     * @var string
     */
    public $tweetFields;

    /**
     * Twitter Media Fields (comma delimited)
     *
     * @var string
     */
    public $mediaFields;

    /**
     * Twitter Place Fields (comma delimited)
     *
     * @var string
     */
    public $placeFields;

    /**
     * Twitter Poll Fields (comma delimited)
     *
     * @var string
     */
    public $pollFields;

    /**
     * Twitter List Fields (comma delimited)
     *
     * @var string
     */
    public $listFields;

    /**
     * Twitter Space Fields (comma delimited)
     *
     * @var string
     */
    public $spaceFields;

    /**
     * Twitter Expansions (comma delimited)
     *
     * @var string
     */
    public $expansions;

    /**
     * The Client Class Constructor
     *
     * The client can be initialized with a combination of API keys, depending on the endpoint.
     * Most get requests only require a bearer token, but some require a user access token.
     * Should only be called privately from scoped clients.
     */
    public function __construct(
        ?string $apiKey = null,
        ?string $apiSecret = null,
        ?string $accessToken = null,
        ?string $accessSecret = null,
        ?string $bearerToken = null,
    ) {
        $this->apiKey = $apiKey;
        $this->apiSecret = $apiSecret;
        $this->accessKey = $accessToken;
        $this->accessSecret = $accessSecret;
        $this->baseUrl = 'https://api.twitter.com/2/';
        $this->bearerToken = $bearerToken;
        $this->client = new \GuzzleHttp\Client();
        $this->spaceFields = 'host_ids,created_at,creator_id,id,lang,invited_user_ids,speaker_ids,started_at,state,title,updated_at,is_ticketed,ended_at,topic_ids';
        $this->listFields = 'created_at,follower_count,member_count,private,description,owner_id';
        $this->userFields = 'created_at,description,entities,id,location,name,pinned_tweet_id,profile_image_url,protected,public_metrics,url,username,verified,withheld';
        $this->tweetFields = 'attachments,author_id,context_annotations,conversation_id,created_at,entities,geo,id,in_reply_to_user_id,lang,possibly_sensitive,public_metrics,referenced_tweets,reply_settings,source,text,withheld';
        $this->expansions = 'attachments.media_keys';
        $this->mediaFields = 'media_key,type,url,duration_ms,height,preview_image_url,public_metrics,width,alt_text,variants';
    }

    /**
     * Make a GET request to the Twitter API.
     *
     * @param string $endpoint
     * @param array|null $params
     * @return TwitterResponse
     */
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

    /**
     * Make a POST request to the Twitter API.
     *
     * @param string $endpoint
     * @param array|null $params
     * @return TwitterResponse
     */
    public function post(string $endpoint, ?array $data = null): TwitterPostResponse
    {
        try {
            $connection = new TwitterOAuth($this->apiKey, $this->apiSecret, $this->accessKey, $this->accessSecret);
            $connection->setApiVersion('2');

            $response = $connection->post($endpoint, $data, true);

        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }

        if (isset($response->errors)) {
            throw new \Exception($response->errors[0]->message);
        }

        return new TwitterPostResponse($response);
    }

    /**
     * Make a DELETE request to the Twitter API.
     *
     * @param string $endpoint
     * @param array|null $params
     * @return TwitterResponse
     */
    public function delete(string $endpoint, array $data): TwitterPostResponse
    {
        try {
            $connection = new TwitterOAuth($this->apiKey, $this->apiSecret, $this->accessKey, $this->accessSecret);
            $connection->setApiVersion('2');

            $response = $connection->delete($endpoint, $data);

            
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }

        if (isset($response->errors)) {
            throw new \Exception($response->errors[0]->message);
        }

        return new TwitterPostResponse($response);
    }

    /**
     * Make a PUT request to the Twitter API.
     *
     * @param string $endpoint
     * @param array|null $params
     * @return TwitterResponse
     */
    public function put(string $endpoint, ?array $data = null): TwitterPostResponse
    {
        try {
            $connection = new TwitterOAuth($this->apiKey, $this->apiSecret, $this->accessKey, $this->accessSecret);
            $connection->setApiVersion('2');

            $response = $connection->put($endpoint, $data);
            
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }

        if (isset($response->errors)) {
            throw new \Exception($response->errors[0]->message);
        }

        return new TwitterPostResponse($response);
    }

    public function getRequestToken(string $oauthCallback): array
    {
        $connection = new TwitterOAuth($this->apiKey, $this->apiSecret);
        $requestToken = $connection->oauth('oauth/request_token', ['oauth_callback' => $oauthCallback]);

        return $requestToken;
    }

    public function getAuthorizeUrl(array $requestToken): string
    {
        $connection = new TwitterOAuth($this->apiKey, $this->apiSecret, $requestToken['oauth_token'], $requestToken['oauth_token_secret']);
        $url = $connection->url('oauth/authorize', ['oauth_token' => $requestToken['oauth_token']]);

        return $url;
    }

    public function getAccessToken(string $oauthToken, string $oauthSecret, string $oauthVerifier): array
    {
        $connection = new TwitterOAuth(
            $this->apiKey,
            $this->apiSecret,
            $oauthToken,
            $oauthSecret,
        );

        $accessToken = $connection->oauth('oauth/access_token', [
            'oauth_verifier' => $oauthVerifier,
        ]);

        return $accessToken;
    }
}
