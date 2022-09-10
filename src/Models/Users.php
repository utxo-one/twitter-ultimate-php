<?php

namespace UtxoOne\TwitterUltimatePhp\Models;

class Users extends BaseModel
{
    public function all(): array
    {
        $users = [];

        foreach ($this->data as $user) {
            $users[] = new User($user);
        }

        return $users;
    }

    public function getPaginationToken(): ?string
    {
        return (isset($this->meta['next_token'])) ? $this->meta['next_token'] : null;
    }

    public function getResultCount(): int
    {
        return $this->meta['result_count'];
    }
}
