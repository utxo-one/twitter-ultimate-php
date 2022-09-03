<?php

namespace UtxoOne\TwitterUltimatePhp\Client;

use UtxoOne\TwitterUltimatePhp\Models\Tweets;
use UtxoOne\TwitterUltimatePhp\Models\TwitterList;
use UtxoOne\TwitterUltimatePhp\Models\User;

class ListClient extends Client
{
    public function getList(string $id): TwitterList
    {
        $response = $this->get('lists/' . $id, [
            'list.fields' => $this->listFields,
        ]);

        return new TwitterList($response->getData());
    }

    public function getUserOwnedLists(string $id): User
    {
        $response = $this->get('users/' . $id . '/owned_lists', [
            'list.fields' => $this->listFields,
        ]);

        return new User($response->getData());
    }

    public function getListTweets(string $id): Tweets
    {
        $response = $this->get('lists/' . $id . '/tweets', [
            'list.fields' => $this->listFields,
        ]);

        return new Tweets($response->getData());
    }
}