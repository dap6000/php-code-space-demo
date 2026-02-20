<?php

function say(string $msg):void  {
    echo '<div><h1>Recieved Input</h1>', $msg, '</div>';
}

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