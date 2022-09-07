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

 - `getTweet()`
 - `getTweets()`
 - `getQuoteTweets()`
 - `getLikingUsers()`
 - `getRetweetedByUsers()`
 - `tweet()`
 - `deleteTweet()`
 - `likeTweet()`
 - `unlikeTweet()`
 - `retweet()`
 - `unrtweet()`
 - `bookmarkTweet()`
 - `unbookmarkTweet()`

#### Get Tweet Details

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
#### Get Multiple Tweet Details

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
#### Follow a User

```php
use UtxoOne\TwitterUltimatePhp\Clients\UserClient;

$client = new UserClient(
    apiKey: $_ENV['TWITTER_API_KEY'], 
    apiSecret: $_ENV['TWITTER_API_SECRET'], 
    accessToken: $_ENV['TWITTER_ACCESS_TOKEN'], 
    accessSecret: $_ENV['TWITTER_ACCESS_SECRET'],
);

$user = $client->getUserByUsername('utxo_one');
$tweet = $client->follow($user->getId());

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

### List Management Methods

##### Getting a List's Details

```php

use UtxoOne\TwitterUltimatePhp\Clients\ListClient;

$client = new ListClient(bearerToken: $_ENV['TWITTER_BEARER_TOKEN']);

$list = $client->getList('64651656516516516');
$list->getId();
$list->getFollowerCount();
$list->getCreatedAt();
$list->getMemberCount();
$list->isPrivate();
$list->getDescription();
$list->getOwnerId();

```

#### Create a List

```php
use UtxoOne\TwitterUltimatePhp\Clients\ListClient;

$client = new ListClient(
    apiKey: $_ENV['TWITTER_API_KEY'], 
    apiSecret: $_ENV['TWITTER_API_SECRET'], 
    accessToken: $_ENV['TWITTER_ACCESS_TOKEN'], 
    accessSecret: $_ENV['TWITTER_ACCESS_SECRET'],
);

$list = $client->createList(
  name: 'My New List',
  description: 'My New List Description',
  private: false,
);

$list->getId();

```

#### Available Methods

 - `getList()`
 - `getUserOwnedLists()`
 - `getListTweets()`
 - `getListMembers()`
 - `getUserMemberships()`
 - `getListFollowers()`
 - `getUserFollowedLists()`
 - `getUserPinnedLists()`
 - `createList()`
 - `updateList()`
 - `deleteList()`
 - `addListMember()`
 - `removeListMember()`
 - `followList()`
 - `unfollowList()`
 - `pinList()`
 - `unpinList()`

 ### Space Management Methods

##### Getting a Space's Details

```php

use UtxoOne\TwitterUltimatePhp\Clients\SpaceClient;

$client = new SpaceClient(bearerToken: $_ENV['TWITTER_BEARER_TOKEN']);

$space = $client->getSpace('64651656516516516');
$space->getId();
$space->getTitle();
$space->getCreatedAt();
$space->getUpdatedAt();
$space->getHostIds();
$space->getState();
$space->isTicketed();
$space->getLand();
$space->getCreatorId();

```


