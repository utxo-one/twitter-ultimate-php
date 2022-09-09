<?php

namespace UtxoOne\TwitterUltimatePhp\Clients;

use UtxoOne\TwitterUltimatePhp\Models\Tweets;
use UtxoOne\TwitterUltimatePhp\Models\TwitterList;
use UtxoOne\TwitterUltimatePhp\Models\TwitterLists;
use UtxoOne\TwitterUltimatePhp\Models\TwitterPostResponse;
use UtxoOne\TwitterUltimatePhp\Models\Users;

class ListClient extends BaseClient
{
    /**
     * Get List Details
     *
     * @param string $id
     * @return TwitterList
     */
    public function getList(string $id): TwitterList
    {
        $response = $this->get('lists/' . $id, [
            'list.fields' => $this->listFields,
        ]);

        return new TwitterList($response->getData());
    }

    public function getUserOwnedLists(string $id, ?int $maxResults = 100, ?string $paginationToken = null): TwitterLists
    {
        $response = $this->get('users/' . $id . '/owned_lists', [
            'list.fields' => $this->listFields,
            'max_results' => $maxResults,
            'pagination_token' => $paginationToken,
        ]);

        return new TwitterLists($response->getData());
    }

    public function getListTweets(string $id, ?int $maxResults = 100, ?string $paginationToken = null): Tweets
    {
        $response = $this->get('lists/' . $id . '/tweets', [
            'tweet.fields' => $this->tweetFields,
            'max_results' => $maxResults,
            'pagination_token' => $paginationToken,
        ]);

        return new Tweets($response->getData());
    }

    public function getListMembers(string $id, ?int $maxResults = 100, ?string $paginationToken = null): Users
    {
        $response = $this->get('lists/' . $id . '/members', [
            'user.fields' => $this->userFields,
            'max_results' => $maxResults,
            'pagination_token' => $paginationToken,
        ]);

        return new Users($response->getData());
    }

    public function getUserMemberships(string $id, ?int $maxResults = 100, ?string $paginationToken = null): TwitterLists
    {
        $response = $this->get('users/' . $id . '/list_memberships', [
            'list.fields' => $this->listFields,
            'max_results' => $maxResults,
            'pagination_token' => $paginationToken,
        ]);

        return new TwitterLists($response->getData());
    }

    public function getListFollowers(string $id, ?int $maxResults = 100, ?string $paginationToken = null): Users
    {
        $response = $this->get('lists/' . $id . '/followers', [
            'user.fields' => $this->userFields,
            'max_results' => $maxResults,
            'pagination_token' => $paginationToken,
        ]);

        return new Users($response->getData());
    }

    public function getUserFollowedLists(string $id, ?int $maxResults = 100, ?string $paginationToken = null): TwitterLists
    {
        $response = $this->get('users/' . $id . '/followed_lists', [
            'list.fields' => $this->listFields,
            'max_results' => $maxResults,
            'pagination_token' => $paginationToken,
        ]);

        return new TwitterLists($response->getData());
    }

    public function getUserPinnedLists(string $id, ?int $maxResults = 100, ?string $paginationToken = null): TwitterLists
    {
        $response = $this->get('users/' . $id . '/pinned_lists', [
            'list.fields' => $this->listFields,
            'max_results' => $maxResults,
            'pagination_token' => $paginationToken,
        ]);

        return new TwitterLists($response->getData());
    }

    public function createList(string $name, string $description = null, ?bool $private = false): TwitterList
    {
        $response = $this->post('lists', [
            'name' => $name,
            'description' => $description,
            'private' => $private,
        ]);

        return new TwitterList($response->getData());
    }

    public function updateList(string $id, string $name, string $description = null, ?bool $private = false): TwitterList
    {
        $response = $this->put('lists/' . $id, [
            'name' => $name,
            'description' => $description,
            'private' => $private,
        ]);

        return new TwitterList($response->getData());
    }

    public function deleteList(string $id): bool
    {
        $response = $this->delete('lists/' . $id, []);

        if (!isset($response->response->data)) {
            return false;
        }

        return true;
    }

    public function addListMember(string $id, string $userId): bool
    {
        $response = $this->post('lists/' . $id . '/members', [
            'user_id' => $userId,
        ]);

        if (!isset($response->response->data)) {
            return false;
        }

        return true;
    }

    public function removeListMember(string $id, string $userId): bool
    {
        $response = $this->delete('lists/' . $id . '/members/' . $userId, []);

        if (!isset($response->response->data)) {
            return false;
        }

        return true;
    }

    public function followList(string $listId, string $userId): bool
    {
        $response = $this->post('users/' . $userId . '/followed_lists', [
            'list_id' => $listId,
        ]);

        if (!isset($response->response->data)) {
            return false;
        }

        return true;
    }

    public function unfollowList(string $listId, string $userId): bool
    {
        $response = $this->delete('users/' . $userId . '/followed_lists/' . $listId, []);

        if (!isset($response->response->data)) {
            return false;
        }

        return true;
    }

    public function pinList(string $listId, string $userId): bool
    {
        $response = $this->post('users/' . $userId . '/pinned_lists', [
            'list_id' => $listId,
        ]);

        if (!isset($response->response->data)) {
            return false;
        }

        return true;
    }

    public function unpinList(string $listId, string $userId): bool
    {
        $response = $this->delete('users/' . $userId . '/pinned_lists/' . $listId, []);

        if (!isset($response->response->data)) {
            return false;
        }

        return true;
    }


}
