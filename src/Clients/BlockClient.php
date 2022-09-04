<?php

namespace UtxoOne\TwitterUltimatePhp\Clients;

use UtxoOne\TwitterUltimatePhp\Models\Users;

class BlockClient extends BaseClient
{
    public function getBlocks(string $id): Users
    {
        $response = $this->get('users/' . $id . '/blocking', [
            'user.fields' => 'created_at',
        ]);

        return new Users($response->getData());
    }
}