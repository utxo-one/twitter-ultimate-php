<?php

namespace UtxoOne\TwitterUltimatePhp\Models;

class TwitterPostResponse
{
    public function __construct(public object $response)
    {
    }

    public function getData()
    {
        if (isset($this->response->data)) {
            return (array)$this->response->data;
        }
    }
}
