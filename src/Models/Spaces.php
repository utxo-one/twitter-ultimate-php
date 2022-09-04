<?php

namespace UtxoOne\TwitterUltimatePhp\Models;

class Spaces
{
    public function __construct(private array $data)
    {
    }

    public function all(): array
    {
        $spaces = [];

        foreach ($this->data as $space) {
            $spaces[] = new Space($space);
        }

        return $spaces;
    }
}
