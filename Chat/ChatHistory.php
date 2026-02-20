<?php

declare(strict_types = 1);

namespace RisingTeam\Chat;

final readonly class ChatHistory
{
    public function __construct(
        private string $filePath = __DIR__ . '/chat_history.dat',
        private array $messages = []
    ) {
        $this->filePath = $filePath;
    }

    public function addMessage(string $message): void
    {
        $this->messages[] = $message;
        $this->save();
    }

    public function getMessages(): array
    {
        $this->read();
        return $this->messages;
    }

    public function save(): void
    {
        file_put_contents($this->filePath, serialize($this->messages));
    }

    public function read(): void
    {
        if (!file_exists($this->filePath)) {
            $this->messages = [];
            return;
        }
        $data = file_get_contents($this->filePath);
        $this->messages = unserialize($data) ?: [];
    }
}