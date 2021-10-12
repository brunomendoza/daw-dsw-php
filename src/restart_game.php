<?php
require_once("functions.php");
require_once("acme/model/Location.php");
require_once("acme/CharacterFactory.php");

use acme\model\Location;
use acme\CharacterFactory;

$columnQuantity = 5;
$rowQuantity = 5;

$cookieName = "acme";
removeCookie($cookieName);

$characterFactory = new CharacterFactory($columnQuantity, $rowQuantity);

$runnerCharacter = $characterFactory->createCharacter("runner", "./assets/acme/roadrunner-running-120w.png");
$coyoteCharacter = $characterFactory->createCharacter("coyote", "./assets/acme/coyote-running-120w.png");
$cliffCharacter = $characterFactory->createCharacter("cliff", "./assets/acme/cliff-120w.png");

session_start();

if (!isset($_SESSION[$cookieName])) {
    $_SESSION[$cookieName] = json_encode(array($runnerCharacter, $coyoteCharacter, $cliffCharacter), JSON_PRETTY_PRINT);
} else {
    echo $_SESSION[$cookieName];
}
