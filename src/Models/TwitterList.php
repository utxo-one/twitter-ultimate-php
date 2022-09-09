<?php

namespace UtxoOne\TwitterUltimatePhp\Models;

class TwitterList extends BaseModel
{
    public function getId(): string
    {
        return $this->data['id'];
    }

    public function getCreatedAt(): string
    {
        return $this->data['created_at'];
    }

    public function getFollowerCount(): string
    {
        return $this->data['follower_count'];
    }

    public function getMemberCount(): string
    {
        return $this->data['member_count'];
    }

    public function isPrivate(): bool
    {
        return $this->data['private'];
    }

    public function getDescription(): ?string
    {
        return (isset($this->data['description']) ? $this->data['description'] : null);
    }

    public function getOwnerId(): ?string
    {
        return (isset($this->data['owner_id']) ? $this->data['owner_id'] : null);
    }
}
