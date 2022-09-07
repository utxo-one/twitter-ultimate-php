## Twitter Ultimate PHP

A complete and opinionated API Wrapper implementation for the Twitter v2 API. Full docblocks for all methods and strict
return types make it easy for developers by providing all the method names and parameters to your IDE.

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

The tweet client can be initialized either to get public information, or to perform authenticated actions.

#### Public API Calls

You only need to provide your `bearerToken` to initialize a tweet client that accesses public information.

```php
use UtxoOne\TwitterUltimatePhp\Clients\TweetClient;

$client = new TweetClient(bearerToken: $_ENV['TWITTER_BEARER_TOKEN']);

$tweet = $client->getTweet('1272846378268347');
```
#### Authenticated API Calls

To make an authenticated API call, you need to provide your `apiToken` , `apiSecret`, `accessToken`, `accessSecret`.
Access tokens are generated after the user authenticates your app.

```php
use UtxoOne\TwitterUltimatePhp\Clients\TweetClient;

$client = new TweetClient(
    apiKey: $_ENV['TWITTER_API_KEY'], 
    apiSecret: $_ENV['TWITTER_API_SECRET'], 
    accessToken: $_ENV['TWITTER_ACCESS_TOKEN'], 
    accessSecret: $_ENV['TWITTER_ACCESS_SECRET'],
);

$tweet = $client->tweet('Hello World!');
```

#### Available Tweet Client Methods:

 - getTweet()
 - getTweets()
 - getQuoteTweets()
 - getLikingUsers()
 - getRetweetedByUsers()
 - tweet()
 - deleteTweet()
 - likeTweet()
 - unlikeTweet()
 - retweet()
 - unrtweet()
 - bookmarkTweet()
 - unbookmarkTweet()

`getTweet()`

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
`getTweets()`

```php
use UtxoOne\TwitterUltimatePhp\Clients\TweetClient;

$client = new TweetClient(bearerToken: $_ENV['TWITTER_BEARER_TOKEN']);
$tweets = $client->getTweets(['1565628118001455105', '1565999511536914433'])->all();

foreach($tweets as $tweet) {
  $tweet->getId();
  // ...
}
```
### User Management Methods

##### Getting a User's Details

```php

use UtxoOne\TwitterUltimatePhp\Clients\UserClient;

$client = new UserClient(bearerToken: $_ENV['TWITTER_BEARER_TOKEN']);

$user = $client->getUserByUsername('utxoone');
$user->getId();
$user->getName();
$user->getUsername();
$user->getCreatedAt();
$user->getDescription();
$user->getLocation();
$user->getPinnedTweetId();
$user->getProfileImageUrl();
$user->getUrl();
$user->isVerified();
$user->isProtected();
$user->getEntities();
```

##### Getting a User's Liked Tweets

```php

use UtxoOne\TwitterUltimatePhp\Clients\UserClient;

$client = new UserClient(bearerToken: $_ENV['TWITTER_BEARER_TOKEN']);

$user = $client->getUserByUsername('utxoone');
$likedTweets = $client->getLikedTweets($user->getId());

foreach ($likedTweets as $likedTweet) {
  $likedTweet->getId();
  $likedTweet->getText();
  // ...
}
```

##### Available Methods

 - `getUserByUsername()`
 - `getUserById()`
 - `getLikedTweets()`
 - `getFollowers()`
 - `getFollowing()`
 - `follow()`
 - `unfollow()`
 - `getBlocks()`
 - `block()`
 - `unblock()`
 - `mute()`
 - `unmute()`

<p align="right">(<a href="#readme-top">back to top</a>)</p>
