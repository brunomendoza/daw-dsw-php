<?php

namespace connectfour\model;

use JsonSerializable;

class Token implements JsonSerializable {
    private bool $empty;
    private string $color;

    public function __construct(bool $empty = true, string $color = "blank") {
        $this->empty = $empty;
        $this->color = $color;
    }

    public function isEmpty() {
        return $this->empty;
    }

    public function setEmpty(bool $empty) {
        $this->empty = $empty;
    }

    public function getColor() {
        return $this->color;
    }

    public function setColor(string $color) {
        $this->color = $color;
    }

    public function jsonSerialize() {
        return array(
            "color" => $this->color,
            "empty" => $this->empty
        );
    }
}

?>