<?php
namespace acme;

require_once("model/Character.php");
require_once("model/Location.php");

use acme\model\{Character, Location};

class CharacterFactory {
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
        foreach ($characters as $name => $character) {
            if ($character->getLocation()->areEqual($location)) {
                return true;
            }
        }

        return false;
    }
}

?>