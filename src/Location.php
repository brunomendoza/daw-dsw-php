<?php

class Location
{
    private $x;
    private $y;

    function __construct($x, $y)
    {
        $this->$x = $x;
        $this->$y = $y;
    }

    function getX() {
        return $this->$x;
    }

    function getY() {
        return $this->$y;
    }
}

?>