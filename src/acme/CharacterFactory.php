<?php
namespace acme;

// require_once("./model/Location.php");
// require_once("./model/Character.php");

use model\{Character, Location};

class CharacterFactory {
    private array $locations;
    private array $characters;
    private int $column;
    private int $row;

    public function __construct($column, $row) {
        $this->column = $column;
        $this->row = $row;
        $this->locations = array();
        $this->characters = array();
    }

    public function createCharacter(string $name, string $pictureUrl) {
        $location = CharacterFactory::generateLocation($this->column, $this->row);
        $character = new Character($name, $pictureUrl, $location);

        $characters[$name] = $character;

        return $character;
    }

    private static function generateLocation(int $column, int $row) {
        $x = rand(0, $column);
        $y = rand(0, $row);

        return new Location($x, $y);
    }

    private function locationExists(Location $location) {
        $locationExists = false;
        $i = 0;
    
        if (count($this->locations) > 0) {
            while (!$locationExists && $i < count($this->locations)) {
                if ($this->locations[$i]->areEqual($location)) {
                    $locationExists = true;
                }
    
                $i++;
            }
        }
    
        return $locationExists;
    }
}