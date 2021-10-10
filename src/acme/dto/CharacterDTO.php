<?php
namespace acme\dto;

class CharacterDTO implements JsonSerializable {
    private string $url;
    private string $location;

    public function __construct(string $url, string $location) {
        $this->location = $location;
        $this->url = $url;
    }

    public function jsonSerialize() {
        return [
            'url' => $this->url,
            'location' => $this->location 
        ];
    }

    public function toString() {
        printf("url: %s, location: %s", $this->url, $this->location);
    }
}

?>