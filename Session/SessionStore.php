<?php

declare(strict_types = 1);

namespace RisingTeam\Session;

final class SessionStore   
{
    private SessionState $state;

    public function __construct(SessionState $state)
    {
        $this->state = $state;
    }

    public function getState(): SessionState
    {
        return $this->state ?? $this->fetchStateFromStorage();
    }

    public function saveState(SessionState $state): void
    {
        $this->state = $state;
        // Serialize the state and write to file
        $serialized = $state->serialize();
        $filePath = __DIR__ . '/session_state.dat';
        file_put_contents($filePath, $serialized);
    }

    private function fetchStateFromStorage(): SessionState
    {
        $filePath = __DIR__ . '/session_state.dat';
        if (!file_exists($filePath)) {
            throw new \RuntimeException('Session state file not found.');
        }
        $serialized = file_get_contents($filePath);
        $data = unserialize($serialized);
        return new SessionState(
            $data['name'] ?? '',
            $data['topic'] ?? '',
            $data['level'] ?? ''
        );
    }
}