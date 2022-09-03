<?php

namespace UtxoOne\TwitterUltimatePhp\Client;

use UtxoOne\TwitterUltimatePhp\Models\User;

class UserLookup extends Client
{
    public function getUserByUsername(string $username): User
    {
        $response = $this->get('users/by/username/' . $username, [
            'user.fields' => $this->userFields,
        ]);

        return new User($response->getData());
    }

    public function getUserById(string $id): User
    {
        $response = $this->get('users/' . $id, [
            'user.fields' => $this->userFields,
        ]);

        return new User($response->getData());
    }
}