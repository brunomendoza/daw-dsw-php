<?php
namespace acme\model;

use JsonSerializable;

class Character implements JsonSerializable {
    private string $pictureUrl;
    private Location $location;
    private string $name;

    public function __construct(string $name, string $url, Location $location) {
        $this->name = $name;
        $this->url = $url;
        $this->location = $location;
    }

    public function getLocation() {
        return $this->location;
    }

    public function getPictureUrl() {
        return $this->url;
    }

    public function getName() {
        return $this->name;
    }

    public function toString() {
        return printf("url: %s, location: [%d, %d]", $this->pictureUrl, $this->location->getX(), $this->location->getY());
    }

    public function jsonSerialize() {
        return [
            "name" => $this->name,
            'url' => $this->url,
            'location' => $this->location 
        ];
    }
}