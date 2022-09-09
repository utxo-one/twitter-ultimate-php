<?php

namespace UtxoOne\TwitterUltimatePhp\Models;

class TwitterLists extends BaseModel
{
    public function all(): array
    {
        $twitterLists = [];

        foreach ($this->data as $twitterList) {
            $twitterLists[] = new Tweet($twitterList);
        }

        return $twitterLists;
    }

    public function getPaginationToken(): ?string
    {
        return $this->meta['next_token'];
    }

    public function getResultCount(): int
    {
        return $this->meta['result_count'];
    }
}
