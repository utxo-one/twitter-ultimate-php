<?php

namespace UtxoOne\TwitterUltimatePhp\Client;

use UtxoOne\TwitterUltimatePhp\Models\Users;

class Blocks extends Client
{
    public function getBlocks(string $id): Users
    {
        $response = $this->get('users/' . $id . '/blocking', [
            'user.fields' => 'created_at',
        ]);

        return new Users($response->getData());
    }
}