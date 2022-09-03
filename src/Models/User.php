<?php

namespace UtxoOne\TwitterUltimatePhp\Models;

class User
{
    public function __construct(private array $data)
    {
    }

    public function getId(): string
    {
        return $this->data['id'];
    }

    public function getName(): string
    {
        return $this->data['name'];
    }

    public function getUsername(): string
    {
        return $this->data['username'];
    }
}