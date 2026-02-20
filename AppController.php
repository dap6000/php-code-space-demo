<?php

declare(strict_types=1);

use RisingTeam\Session\SessionState;
use RisingTeam\Session\SessionStore;

class AppController
{
    private SessionStore $store;
    private ?SessionState $state = null;

    public function __construct()
    {
        $this->store = new SessionStore(new SessionState('', '', ''));
        try {
            $this->state = $this->store->getState();
        } catch (Throwable $e) {
            $this->state = new SessionState('', '', '');
        }
    }

    public function onboard(): ?SessionState
    {
        $step = $_POST['onboard_step'] ?? 1;
        $name = $this->state->name ?? '';
        $topic = $this->state->topic ?? '';
        $level = $this->state->level ?? '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if ($step == 1 && isset($_POST['name'])) {
                $name = trim($_POST['name']);
                $this->state = new SessionState($name, $topic, $level);
                $this->store->saveState($this->state);
                $step = 2;
            } elseif ($step == 2 && isset($_POST['topic'])) {
                $topic = trim($_POST['topic']);
                $this->state = new SessionState($name, $topic, $level);
                $this->store->saveState($this->state);
                $step = 3;
            } elseif ($step == 3 && isset($_POST['level'])) {
                $level = trim($_POST['level']);
                $this->state = new SessionState($name, $topic, $level);
                $this->store->saveState($this->state);
                // Onboarding complete
                return $this->state;
            }
        }

        echo '<div style="position:fixed;top:0;left:0;width:100vw;height:100vh;background:rgba(0,0,0,0.5);display:flex;align-items:center;justify-content:center;z-index:1000;">';
        echo '<form method="post" style="background:#fff;padding:2em;border-radius:8px;min-width:300px;">';
        if ($step == 1) {
            echo '<label>What is your name?<br><input name="name" required value="' . htmlspecialchars($name) . '"></label><br><br>';
        } elseif ($step == 2) {
            echo '<label>What topic would you like to learn?<br><input name="topic" required value="' . htmlspecialchars($topic) . '"></label><br><br>';
        } elseif ($step == 3) {
            echo '<label>What is your current skill level in this topic?<br><input name="level" required value="' . htmlspecialchars($level) . '"></label><br><br>';
        }
        echo '<input type="hidden" name="onboard_step" value="' . $step . '">';
        echo '<button type="submit">Next</button>';
        echo '</form></div>';
        exit;
    }

    public function handleMessage(): void
    {
        if (!empty($_POST['message'])) {
            $cleanInput = htmlspecialchars($_POST['message']);
            $this->say($cleanInput);
        }
    }

    public function say(string $history): void
    {
        echo '<div>', $history, '</div>';
    }

    public function run(): void
    {
        if (empty($this->state->name) || empty($this->state->topic) || empty($this->state->level)) {
            $this->onboard();
        }
        $this->handleMessage();
    }
}
