<?php

namespace connectfour\model;

use JsonSerializable;

class Player implements JsonSerializable {
    private string $firstName;
    private string $lastName;
    private string $address;
    private string $province;
    private string $country;
    private string $age;
    private string $color;

    public function __construct(
        string $firstName,
        string $lastName,
        string $color,
        string $address,
        string $country,
        string $province,
        string $age
    ) {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->color = $color;

        $this->address = $address;
        $this->province = $province;
        $this->country = $country;
        $this->age = $age;
    }

    public function getFirstName() {
        return $this->firstName;
    }

    public function getLastName() {
        return $this->lastName;
    }

    public function getColor() {
        return $this->color;
    }

    public function getAddress() {
        return $this->address;
    }

    public function getCountry() {
        return $this->country;
    }

    public function getProvince() {
        return $this->province;
    }

    public function getAge() {
        if ($this->age == "a") {
            return "0-20";
        } elseif ($this->age == "b") {
            return "21-60";
        } elseif ($this->age == "c") {
            return "60+";
        } else {
            return "unknown";
        }
    }
    
    public function jsonSerialize() {
        return array(
            "firstName" => $this->firstName,
            "lastName" => $this->lastName,
            "color" => $this->color,
            "address" => $this->address,
            "country" => $this->country,
            "province" => $this->province,
            "age" => $this->age,
        );
    }
}