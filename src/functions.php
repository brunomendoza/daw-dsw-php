<?php

require_once("./acme/model/Character.php");
require_once("./acme/model/Location.php");

use acme\model\{Character, Location};

/**
 * Dices
 */

function greatest_match($values) {
    $greatest = -1;
    $current_value;
    $values_length = count($values);

    if ($values_length > 1) {
        for ($i=0; $i < $values_length; $i++) {
            $current_value = $values[$i];

            if ($values_length > $i + 1) {
                for ($j=$i + 1; $j < $values_length; $j++) { 
                    if ($values[$j] == $current_value && $current_value > $greatest) {
                        $greatest = $current_value;
                    }
                }
            } 
        }
    }

    return $greatest;
}

 /**
  * Coyote and Roadrunner
  */

function locationExists(array $locations, Location $location) {
    $locationExists = false;
    $i = 0;

    if (count($locations) > 0) {
        while (!$locationExists && $i < count($locations)) {
            if ($locations[$i]->areEqual($location)) {
                $locationExists = true;
            }

            $i++;
        }
    }

    return $locationExists;
}

function generateLocation(array &$locations, int $columnLength, int $rowLength) {
    do {
        $x = rand(0, $rowLength - 1);
        $y = rand(0, $columnLength - 1);

        $location = new Location($x, $y);
    } while (locationExists($locations, $location));

    $locations[] = $location;
    
    return $location;
}

function initializeBoard($columnLength, $rowLength) {
    $locations = array();
    
    $roadrunnerPictureUrl = "./assets/acme/roadrunner-running-120w.png";
    $coyotePictureUrl = "./assets/acme/coyote-running-120w.png";
    $cliffPictureUrl = "./assets/acme/cliff-120w.png";
    
    $roadrunnerCharacter = new Character($roadrunnerPictureUrl, generateLocation($locations, $columnLength, $rowLength));
    $coyoteCharacter = new Character($coyotePictureUrl, generateLocation($locations, $columnLength, $rowLength));
    $cliffCharacter = new Character($cliffPictureUrl, generateLocation($locations, $columnLength, $rowLength));
    
    // echo($roadrunnerCharacter->toString());
    
    for ($i=0; $i < $columnLength; $i++) { 
        for ($j=0; $j < $rowLength; $j++) {
            $location = new Location($i, $j);

            if ($roadrunnerCharacter->getLocation()->areEqual($location)) {
                $cell = sprintf("<img src=\"%s\" />", $roadrunnerCharacter->getPictureUrl());
            } elseif ($coyoteCharacter->getLocation()->areEqual($location)) {
                $cell = sprintf("<img src=\"%s\" />", $coyoteCharacter->getPictureUrl());
            } elseif ($cliffCharacter->getLocation()->areEqual($location)) {
                $cell = sprintf("<img src=\"%s\" />", $cliffCharacter->getPictureUrl());
            } else {
                $cell = sprintf("%s:%s", $i, $j);
            }
            
            print("<div class=\"board__cell\">" . $cell . "</div>");
        }
    }
}
  
function cookieExists(string $cookieName) {
    return array_key_exists($cookieName, $_COOKIE,);
}

function removeCookie(string $cookieName) {
    if (cookieExists($cookieName)) {
        setcookie($cookieName, "", time() - 3600);
    }
}
