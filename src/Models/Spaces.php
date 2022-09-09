<?php

namespace UtxoOne\TwitterUltimatePhp\Models;

class Spaces extends BaseModel
{
    public function all(): array
    {
        $spaces = [];

        foreach ($this->data as $space) {
            $spaces[] = new Space($space);
        }

        return $spaces;
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
