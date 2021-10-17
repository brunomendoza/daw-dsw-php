<?php

require_once("acme/model/Character.php");
require_once("acme/model/Location.php");

use acme\model\Character;
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

function fromJsonToCharacter(string $json) {
    $result = array();
    $objects = json_decode($json);
    
    if (count($objects) > 0) {
        for ($i=0; $i < count($objects); $i++) {
            $object = $objects[$i];
            $result[$object->name] = new Character(
                $object->name,
                $object->url,
                $object->location = new Location(
                    $object->location->x,
                    $object->location->y
                )
            );
        }
    }

    return $result;
}

function drawBoard(array $characters, int $columnLength, int $rowLength, bool $hasStarted = false) {
    $coyoteLocation = $characters["coyote"]->getLocation();
    $runnerLocation = $characters["runner"]->getLocation();
    $cliffLocation = $characters["cliff"]->getLocation();

    $results;

    $locations = array();

    if ($runnerLocation->areEqual($cliffLocation)) {
        $character = new Character("runner", "./assets/acme/coyote-falling-120w.png", $characters["runner"]->getLocation());
        $results = array($character);
    } else if ($coyoteLocation->areEqual($cliffLocation)) {
        $results = array(
            $characters["coyote"],
            $characters["runner"]
        );
    } else if($coyoteLocation->areEqual($runnerLocation)) {
        echo "Coyote Wins!";
        $character = new Character("coyote", "./assets/acme/coyote-smilling-120w.png", $characters["coyote"]->getLocation());

        $results = array(
            $character,
            $characters["cliff"]
        );
    } else {
        $results = $characters;
    }

    for ($i=0; $i < $columnLength; $i++) { 
        for ($j=0; $j < $rowLength; $j++) {
            $location = new Location($i, $j);
            $cell = "&nbsp;";

            foreach ($results as $result) {
                if ($result->getLocation()->areEqual($location)) {
                    $cell = sprintf("<img src=\"%s\" />", $result->getPictureUrl());
                }
            }
            
            print("<div class=\"acme__cell\">" . $cell . "</div>");
        }
    }
}

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

function generateCharacters($characters = null) {
    $result = array();
    $columnLength = 5;
    $rowLength = 5;

    if (is_null($characters)) {
        $locations = generateLocations(3, $columnLength, $rowLength);
        
        $result[] = new Character("runner", "./assets/acme/roadrunner-running-120w.png", $locations[0]);
        $result[] = new Character("coyote", "./assets/acme/coyote-running-120w.png", $locations[1]);
        $result[] = new Character("cliff", "./assets/acme/cliff-120w.png", $locations[2]);
    } else {
        $locations = generateLocations(2, $columnLength, $rowLength);

        $result[] = new Character("runner", "./assets/acme/roadrunner-running-120w.png", $locations[0]);
        $result[] = new Character("coyote", "./assets/acme/coyote-running-120w.png", $locations[1]);

        $result[] = $characters["cliff"];
    }

    return $result;
}

function generateLocations(int $quantity, int $columnLength, int $rowLength) {
    $locations = array();

    for ($i=0; $i < $quantity; $i++) {
        do {
            $x = rand(0, $columnLength - 1);
            $y = rand(0, $rowLength - 1);

            $location = new Location($x, $y);
        } while (locationExists($locations, $location));

        $locations[] = $location;
    }

    return $locations;
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