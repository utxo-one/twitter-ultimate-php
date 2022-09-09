<?php

namespace UtxoOne\TwitterUltimatePhp\Models;

class BaseModel
{
    public array $data;
    public array $meta;

    public function __construct(public array $response)
    {
        $this->data = (!isset($response['data'])) ? $this->data = $response : $this->data = $response['data'];      
        $this->meta = ($response['meta'] ?? []);
    }
}