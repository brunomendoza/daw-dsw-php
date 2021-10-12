<?php
use acme\model\Location;

require_once("./functions.php");

$column = 5;
$row = 5;

$cookieName = "acme";
removeCookie($cookieName);

$someArray = array(
    "roadrunner" => generateLocation($column, $row),
    "coyote" => new Location(4, 5)
);

session_start();

if (!isset($_SESSION[$cookieName])) {
    $_SESSION[$cookieName] = json_encode(generateCharaterLocations(5, 5), JSON_PRETTY_PRINT);
}

echo($_SESSION[$cookieName]);