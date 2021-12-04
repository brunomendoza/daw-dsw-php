<?php

namespace dsw\dto;

use \JsonSerializable;
use \DateTime;

class CustomerDTO implements JsonSerializable {
    private string $name;
    private string $surname1;
    private string $surname2;
    private DateTime $birthdate;
    private string $streetName;
    private string $streetNumber;
    private string $postalCode;
    private string $city;
    private string $province;
    private string $country;
    private string $phoneNumber1;
    private string $phoneNumber2;
    private string $email;

    public function __construct(
        string $name,
        string $surname1,
        string $surname2,
        DateTime $birthdate,
        string $streetName,
        string $streetNumber,
        string $postalCode,
        string $city,
        string $province,
        string $country,
        string $phoneNumber1,
        string $phoneNumber2,
        string $email
    ) {
        $this->name = $name;
        $this->surname1 = $surname1;
        $this->surname1 = $surname1;
        $this->surname2 = $surname2;
        $this->birthdate = $birthdate;
        $this->streetName = $streetName;
        $this->streetNumber = $streetNumber;
        $this->postalCode = $postalCode;
        $this->city = $city;
        $this->province = $province;
        $this->country = $country;
        $this->phoneNumber1 = $phoneNumber1;
        $this->phoneNumber2 = $phoneNumber2;
        $this->email = $email;
    }

    public function jsonSerialize() {
        return array(
            "name" => $this->name,
            "surname1" => $this->surname1,
            "surname2" => $this->surname2,
            "birthdate" => $this->birthdate,
            "streetName" => $this->streetName,
            "streetNumber" => $this->streetNumber,
            "postalCode" => $this->postalCode,
            "city" => $this->city,
            "province" => $this->province,
            "country" => $this->country,
            "phoneNumber1" => $this->phoneNumber1,
            "phoneNumber2" => $this->phoneNumber2,
            "email" => $this->email
        );
    }
}