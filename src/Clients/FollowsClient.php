<?php

namespace UtxoOne\TwitterUltimatePhp\Clients;

use UtxoOne\TwitterUltimatePhp\Models\Users;

class FollowsClient extends BaseClient
{
    public function getFollowers(string $id): Users
    {
        $response = $this->get('users/' . $id . '/followers', [
            'user.fields' => 'created_at',
        ]);

        return new Users($response->getData());
    }

    public function getFollowing(string $id): Users
    {
        $response = $this->get('users/' . $id . '/following', [
            'user.fields' => 'created_at',
        ]);

        return new Users($response->getData());
    }
}