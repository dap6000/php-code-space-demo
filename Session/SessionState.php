<?php

declare(strict_types = 1);

namespace RisingTeam\Session;

use Serializable;

final class SessionState
{
    public function __construct(
        public readonly ?string $name,
        public readonly ?string $topic,
        public readonly ?string $level,
    ) {
    }

    public function serialize(): string
    {
        return serialize([
            'name' => $this->name,
            'topic' => $this->topic,
            'level' => $this->level,
        ]);
    }

    public function unserialize($data): void
    {
        $unserializedData = unserialize($data);
        $this->name = $unserializedData['name'];
        $this->topic = $unserializedData['topic'];
        $this->level = $unserializedData['level'];
    }
}