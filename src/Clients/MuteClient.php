<?php

namespace UtxoOne\TwitterUltimatePhp\Clients;

use UtxoOne\TwitterUltimatePhp\Models\Users;

class MuteClient extends BaseClient
{
    public function getMutes(string $id): Users
    {
        $response = $this->get('users/' . $id . '/muting', [
            'user.fields' => $this->userFields,
        ]);

        return new Users($response->getData());
    }
}