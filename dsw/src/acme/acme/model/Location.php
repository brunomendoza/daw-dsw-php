<?php
namespace acme\model;

use JsonSerializable;

class Location implements JsonSerializable {
    private int $x;
    private int $y;

    public function __construct(int $x, int $y) {
        $this->x = $x;
        $this->y = $y;
    }

    public function getX() {
        return $this->x;
    }

    public function getY() {
        return $this->y;
    }

    public function areEqual($location) {
        if ($this->x == $location->getX() && $this->y == $location->getY()) {
            return true;
        }

        return false;
    }

    public function jsonSerialize() {
        return [
            'x' => $this->x,
            'y' => $this->y 
        ];
    }
}

?>