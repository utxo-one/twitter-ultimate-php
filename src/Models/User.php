<?php

namespace UtxoOne\TwitterUltimatePhp\Models;

class User extends BaseModel
{
    public function getId(): string
    {
        return $this->data['id'];
    }

    public function getName(): string
    {
        return $this->data['name'];
    }

    public function getUsername(): string
    {
        return $this->data['username'];
    }

    public function getCreatedAt(): string
    {
        return $this->data['created_at'];
    }

    public function getDescription(): ?string
    {
        return (isset($this->data['description']) ? $this->data['description'] : null);
    }

    public function getLocation(): ?string
    {
        return (isset($this->data['location']) ? $this->data['location'] : null);
    }

    public function getPinnedTweetId(): ?string
    {
        return (isset($this->data['pinned_tweet_id']) ? $this->data['pinned_tweet_id'] : null);
    }

    public function getProfileImageUrl(): ?string
    {
        return (isset($this->data['profile_image_url']) ? $this->data['profile_image_url'] : null);
    }

    public function getUrl(): ?string
    {
        return (isset($this->data['url']) ? $this->data['url'] : null);
    }

    public function isVerified(): ?bool
    {
        return (isset($this->data['verified']) ? $this->data['verified'] : null);
    }

    public function isProtected(): ?bool
    {
        return (isset($this->data['protected']) ? $this->data['protected'] : null);
    }

    public function getEntities(): ?array
    {
        return (isset($this->data['entities']) ? $this->data['entities'] : null);
    }

    public function getPublicMetrics(): ?UserPublicMetrics
    {
        return (isset($this->data['public_metrics']) ? new UserPublicMetrics($this->data['public_metrics']) : null);
    }
}
