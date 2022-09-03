## Twitter Ultimate PHP

An opinionated API Wrapper implementation for the Twitter v2 API. Closely follows the Twitter Postman Library naming conventions.

<!-- GETTING STARTED -->
## Getting Started

You will need a Twitter Developer account, a Project and all your API keys.

### Prerequisites

Install in your local composer app:

  ```sh
  composer require utxo-one/twitter-ultimate-php
  ```

### Installation

Set your .env file with the following variables:

  ```sh
    TWITTER_BEARER_TOKEN=jlkajsdlfkajslkdf
    TWITTER_ADMIN_USER_ID=3456345634563456
  ```
   

<p align="right">(<a href="#readme-top">back to top</a>)</p>



<!-- USAGE EXAMPLES -->
## Usage

Getting a Tweet

```php
   $client = new TweetLookup($bearerToken);
   $tweet = $client->getTweet($tweetId); 
```
Getting a User's Followers

```php
   $client = new Follows($bearerToken);
   $tweet = $client->getFollowers($userId); 
```

<p align="right">(<a href="#readme-top">back to top</a>)</p>



<!-- ROADMAP -->
## Roadmap

- [x] All Get Requests
- [ ] All Post Requests
- [ ] OAuth Flow
- [ ] Documentation
- [ ] Contributor Guidelines