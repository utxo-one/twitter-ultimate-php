<?php

namespace UtxoOne\TwitterUltimatePhp\Models;

use \Psr\Http\Message\ResponseInterface;

class TwitterResponse
{
    public function __construct(public ResponseInterface $response)
    {
    }

    public function getData(): array
    {
        return json_decode($this->response->getBody(), true)['data'];
    }
}