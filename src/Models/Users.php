<?php

namespace UtxoOne\TwitterUltimatePhp\Models;

class Users
{
    public function __construct(private array $data)
    {
    }

    public function all(): array
    {
        $users = [];

        foreach ($this->data as $user) {
            $users[] = new User($user);
        }

        return $users;
    }
}
