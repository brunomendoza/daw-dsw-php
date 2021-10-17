<?php
require_once("functions.php");
require_once("acme/model/Character.php");

use acme\model\Character;

$cookieName = "acme_game";
$hasStartedCookieName = "acme_game_has_started";
$hastStarted = false;
$json;
$characters;

session_start();

if (isset($_SESSION[$cookieName])) {
    $json = $_SESSION[$cookieName];
    
    if (isset($_COOKIE[$hasStartedCookieName])) {
        $hasStarted = boolval($_COOKIE[$hasStartedCookieName]);

        if (!$hasStarted) {
            setcookie($hasStartedCookieName, 1, time() + 24 * 60 * 60);
        } else {
            $characters = fromJsonToCharacter($json);
            $json = json_encode(generateCharacters($characters));
            $_SESSION[$cookieName] = $json;
        }
    }
} else {
    $message = "ERROR";
}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>ACME &mdash; Game</title>
        <link rel="stylesheet" href="./style.css">
    </head>
    <body>
        <div class="acme__wrapper">
            <div class="acme__board">
            <?php
            $characters = fromJsonToCharacter($json);
            drawBoard($characters, 5, 5, $hasStarted);
            ?>
        </div>
        <div class="acme__controls">
            <a href="./start_game.php">Do it again!</a>
            <a id="save-button" href="./save_game.php">Save and Close!</a>
        </div>
    </div>
</body>
</html>