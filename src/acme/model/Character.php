<?php
namespace acme\model;

class Character {
    private string $pictureUrl;
    private Location $location;

    function __construct(string $url, Location $location) {
        $this->url = $url;
        $this->location = $location;
    }

    function getLocation() {
        return $this->location;
    }

    function getPictureUrl() {
        return $this->url;
    }

    function toString() {
        return printf("url: %s, location: [%d, %d]", $this->pictureUrl, $this->location->getX(), $this->location->getY());
    }
}