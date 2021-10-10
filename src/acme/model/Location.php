<?php
namespace acme\model;

class Location {
    private int $x;
    private int $y;

    function __construct(int $x, int $y) {
        $this->x = $x;
        $this->y = $y;
    }

    function getX() {
        return $this->x;
    }

    function getY() {
        return $this->y;
    }

    function areEqual($location) {
        if ($this->x == $location->getX() && $this->y == $location->getY()) {
            return true;
        }

        return false;
    }
}
