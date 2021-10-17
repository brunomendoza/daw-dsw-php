<?php
require_once("functions.php");

$cookieName = "acme_game";
$hasStartedCookieName = "acme_game_has_started";

removeCookie($cookieName);
setcookie($hasStartedCookieName, 0, time() + 24 * 60 * 60);

session_start();

$_SESSION[$cookieName] = json_encode(generateCharacters());


header("Location: start_game.php");
