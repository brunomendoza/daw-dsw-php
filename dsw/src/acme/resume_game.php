<?php
$cookieName = "acme_game";
$hasStartedCookieName = "acme_game_has_started";

setcookie($hasStartedCookieName, 0, time() + 24 * 60 * 60);

session_start();

$_SESSION[$cookieName] = $_COOKIE[$cookieName];

header("Location: start_game.php");