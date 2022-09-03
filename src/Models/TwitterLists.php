<?php

namespace UtxoOne\TwitterUltimatePhp\Models;

class TwitterLists
{
    public function __construct(private array $data)
    {
    }

    public function all(): array
    {
        $twitterLists = [];

        foreach ($this->data as $twitterList) {
            $twitterLists[] = new Tweet($twitterList);
        }

        return $twitterLists;
    }  
}