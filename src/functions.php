<?php

require_once("acme/CharacterFactory.php");
require_once("acme/model/Location.php");

use acme\CharacterFactory;
use acme\model\Location;

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

// function generateUniqueLocation(array $locations, int $columnLength, int $rowLength) {
//     do {
//         $x = rand(0, $rowLength - 1);
//         $y = rand(0, $columnLength - 1);

//         $location = new Location($x, $y);
//     } while (locationExists($locations, $location));
    
//     return $location;
// }

function initializeBoard($columnLength, $rowLength) {
    $characterFactory = new CharacterFactory(5, 5);
    
    $runnerCharacter = $characterFactory->createCharacter("runner", "./assets/acme/roadrunner-running-120w.png");
    $coyoteCharacter = $characterFactory->createCharacter("coyote", "./assets/acme/coyote-running-120w.png");
    $cliffCharacter = $characterFactory->createCharacter("cliff", "./assets/acme/cliff-120w.png");

    for ($i=0; $i < $columnLength; $i++) { 
        for ($j=0; $j < $rowLength; $j++) {
            $location = new Location($i, $j);

            if ($runnerCharacter->getLocation()->areEqual($location)) {
                $cell = sprintf("<img src=\"%s\" />", $runnerCharacter->getPictureUrl());
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
    return isset($_COOKIE[$cookieName]);
}

function removeCookie(string $cookieName) {
    if (cookieExists($cookieName)) {
        setcookie($cookieName, "", time() - 3600);
    }
}

?>