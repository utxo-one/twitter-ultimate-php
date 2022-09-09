<?php

namespace UtxoOne\TwitterUltimatePhp\Models;

class Tweet extends BaseModel
{
    public function getId(): string
    {
        return $this->data['id'];
    }

    public function getText(): string
    {
        return $this->data['text'];
    }

    public function getCreatedAt(): string
    {
        return $this->data['created_at'];
    }

    public function getAuthorId(): string
    {
        return $this->data['author_id'];
    }

    public function getConversationId(): ?string
    {
        return (isset($this->data['conversation_id']) ? $this->data['conversation_id'] : null);
    }

    public function getInReplyToUserId(): ?string
    {
        return (isset($this->data['in_reply_to_user_id']) ? $this->data['in_reply_to_user_id'] : null);
    }

    public function getLang(): ?string
    {
        return (isset($this->data['lang']) ? $this->data['lang'] : null);
    }

    public function getSource(): ?string
    {
        return (isset($this->data['source']) ? $this->data['source'] : null);
    }

    public function isWithheld(): ?bool
    {
        return (isset($this->data['withheld']) ? $this->data['withheld'] : null);
    }

    public function getPublicMetrics(): ?array
    {
        return (isset($this->data['public_metrics']) ? $this->data['public_metrics'] : null);
    }

    public function getReplySettings(): ?string
    {
        return (isset($this->data['reply_settings']) ? $this->data['reply_settings'] : null);
    }

    public function getReferencedTweets(): ?array
    {
        return (isset($this->data['referenced_tweets']) ? $this->data['referenced_tweets'] : null);
    }

    public function getEntities(): ?array
    {
        return (isset($this->data['entities']) ? $this->data['entities'] : null);
    }

    public function getGeo(): ?array
    {
        return (isset($this->data['geo']) ? $this->data['geo'] : null);
    }

    public function getContextAnnotations(): ?array
    {
        return (isset($this->data['context_annotations']) ? $this->data['context_annotations'] : null);
    }

    public function isPossiblySensitive(): ?bool
    {
        return (isset($this->data['possibly_sensitive']) ? $this->data['possibly_sensitive'] : null);
    }

    public function getAttachments(): ?array
    {
        return (isset($this->data['attachments']) ? $this->data['attachments'] : null);
    }
}
