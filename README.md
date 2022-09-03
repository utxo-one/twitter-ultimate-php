## Twitter Ultimate PHP

An opinionated API Wrapper implementation for the Twitter v2 API.

<!-- GETTING STARTED -->
## Getting Started

This is an example of how you may give instructions on setting up your project locally.
To get a local copy up and running follow these simple example steps.

### Prerequisites

Install in your local composer app:

  ```sh
  composer require utxo-one/twitter-ultimate-php
  ```

### Installation

_Below is an example of how you can instruct your audience on installing and setting up your app. This template doesn't rely on any external dependencies or services._

1. Get a free API Key at [https://example.com](https://example.com)
2. Clone the repo
   ```sh
   git clone https://github.com/your_username_/Project-Name.git
   ```
3. Install NPM packages
   ```sh
   npm install
   ```
4. Enter your API in `config.js`
   

<p align="right">(<a href="#readme-top">back to top</a>)</p>



<!-- USAGE EXAMPLES -->
## Usage

Use this space to show useful examples of how a project can be used. Additional screenshots, code examples and demos work well in this space. You may also link to more resources.

```php
   $client = new TweetLookup($bearerToken);
   $client->getTweet($tweetId)->getText(); // "The text from the tweet"
   ```

<p align="right">(<a href="#readme-top">back to top</a>)</p>



<!-- ROADMAP -->
## Roadmap

- [x] All Get Requests
- [ ] All Post Requests
- [ ] OAuth Flow
- [ ] Documentation
- [ ] Contributor Guidelines