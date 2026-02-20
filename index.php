
<?php
require_once __DIR__ . '/Session/SessionStore.php';
require_once __DIR__ . '/Session/SessionState.php';
use RisingTeam\Session\SessionState;
use RisingTeam\Session\SessionStore;

function say(string $history):void  {
    echo '<div>', $history, '</div>';
}

function onboard() {
    $store = new SessionStore(new SessionState('', '', ''));
    try {
        $state = $store->getState();
    } catch (\Throwable $e) {
        $state = new SessionState('', '', '');
    }
    $step = $_POST['onboard_step'] ?? 1;
    $name = $state->name ?? '';
    $topic = $state->topic ?? '';
    $level = $state->level ?? '';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if ($step == 1 && isset($_POST['name'])) {
            $name = trim($_POST['name']);
            $state = new SessionState($name, $topic, $level);
            $store->saveState($state);
            $step = 2;
        } elseif ($step == 2 && isset($_POST['topic'])) {
            $topic = trim($_POST['topic']);
            $state = new SessionState($name, $topic, $level);
            $store->saveState($state);
            $step = 3;
        } elseif ($step == 3 && isset($_POST['level'])) {
            $level = trim($_POST['level']);
            $state = new SessionState($name, $topic, $level);
            $store->saveState($state);
            // Onboarding complete
            return $state;
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
onboard();

?>

<html>
<head>
    <title>Hello, Rising Team!</title>
</head>
<body>

<form method="post" action="/">
    <label for="message">
        <p>Enter message:</p>
        <textarea name="message" id="message"></textarea>
    </label>
    <button type="submit">Submit</button>
</form>

<?php
if (!empty($_POST['message'])) {
    $cleanInput = htmlspecialchars($_POST['message']);
    say($cleanInput);
}
?>
</body>
</html>