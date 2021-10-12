<?php

require_once("acme/CharacterFactory.php");

use acme\CharacterFactory;

session_start();

if (isset($_SESSION["acme"])) {
    $objCharacters = json_decode($_SESSION["acme"]);
    print_r($objCharacters);
    foreach ($objCharacters as $key => $character) {
        echo $character->name;
        echo $character->url;
        echo $character->location->x;
        echo $character->location->y;
        echo "\r\n";
    }
} else {
    echo "Ups!";
}