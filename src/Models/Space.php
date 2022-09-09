<?php

namespace UtxoOne\TwitterUltimatePhp\Models;

class Space extends BaseModel
{
    public function getId(): string
    {
        return $this->data['id'];
    }

    public function getTitle(): string
    {
        return $this->data['title'];
    }

    public function getCreatedAt(): string
    {
        return $this->data['created_at'];
    }

    public function getUpdatedAt(): string
    {
        return $this->data['updated_at'];
    }

    public function getHostIds(): array
    {
        return $this->data['host_ids'];
    }

    public function getState(): string
    {
        return $this->data['state'];
    }

    public function isTicketed(): bool
    {
        return $this->data['is_ticketed'];
    }

    public function getLang(): ?string
    {
        return (isset($this->data['lang']) ? $this->data['lang'] : null);
    }

    public function getCreatorId(): string
    {
        return $this->data['creator_id'];
    }
}
