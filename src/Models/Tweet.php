<?php

namespace UtxoOne\TwitterUltimatePhp\Models;

class Tweet
{
    public function __construct(private array $data)
    {
    }

    public function getId(): string
    {
        return $this->data['id'];
    }

    public function getText(): string
    {
        return $this->data['text'];
    }   
}