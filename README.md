## Twitter Ultimate PHP (WORK IN PROGRESS)

An opinionated API Wrapper implementation for the Twitter v2 API. Closely follows the Twitter Postman Library naming conventions.

### Prerequisites

 - => PHP 8.1
 - Composer
 - Twitter Developer Account


### Installation

  ```sh
  composer require utxo-one/twitter-ultimate-php
  ```
   
## Usage

### Tweet Client

Get Tweet Details

```php
use UtxoOne\TwitterUltimatePhp\Clients\TweetClient;

$client = new TweetClient(bearerToken: $_ENV['TWITTER_BEARER_TOKEN']);
$tweet = $client->getTweet('1565628118001455105');

// Available Getter Methods.
$tweet->getId();
$tweet->getText();
$tweet->getCreatedAt();
$tweet->getAuthorId();
$tweet->getConversationId();
$tweet->getInReplyToUserId();
$tweet->getLang();
$tweet->getSource();
$tweet->isWithheld();
$tweet->getPublicMetricS();
$tweet->getReplySettings();
$tweet->getReferencedTweets();
$tweet->getEntities();
$tweet->getGeo();
$tweet->getContextAnnotations();
$tweet->isPossiblySensitive();
$tweet->getAttachements();
```
Get Tweets

```php
use UtxoOne\TwitterUltimatePhp\Clients\TweetClient;

$client = new TweetClient(bearerToken: $_ENV['TWITTER_BEARER_TOKEN']);
$tweets = $client->getTweets(['1565628118001455105', '1565999511536914433'])->all();

foreach($tweets as $tweet) {
  $tweet->getId();
  // ...
}
```
Get Quote Tweets

```php
use UtxoOne\TwitterUltimatePhp\Clients\TweetClient;

$client = new TweetClient(bearerToken: $_ENV['TWITTER_BEARER_TOKEN']);
$quoteTweets = $client->getQuoteTweets(['1565628118001455105', '1565999511536914433'])->all();

foreach($quoteTweets as $quoteTweet) {
  $quoteTweet->getId();
  // ...
}
```
### User Management Methods

Getting a User's Followers

```php
   $client = new Follows($bearerToken);
   $followers = $client->getFollowers($userId)->all(); // Array of Users
```

<p align="right">(<a href="#readme-top">back to top</a>)</p>
