<?php

namespace UtxoOne\TwitterUltimatePhp\Clients;

use UtxoOne\TwitterUltimatePhp\Models\TwitterResponse;
use \Abraham\TwitterOAuth\TwitterOAuth;

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
