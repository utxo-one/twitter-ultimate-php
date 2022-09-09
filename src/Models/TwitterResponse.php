<?php

namespace UtxoOne\TwitterUltimatePhp\Models;

use Psr\Http\Message\ResponseInterface;

class TwitterResponse
{
    public function __construct(public ResponseInterface $response)
    {
    }

    public function getData(): array
    {
        return (isset(json_decode($this->response->getBody(), true)['data'])) ? json_decode($this->response->getBody(), true) : [];
    }
}
