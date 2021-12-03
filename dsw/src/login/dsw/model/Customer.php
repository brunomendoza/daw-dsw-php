<?php

namespace dsw\model;

use \DateTime;

class Customer {
    private ?string $username;
    private ?string $password;
    private ?int $customerID;

    private string $name;
    private string $surname1;
    private string $surname2;
    private DateTime $birthdate;
    private string $streetName;
    private int $streetNumber;
    private string $postalCode;
    private int $cityID;
    private int $provinceID;
    private int $countryID;
    private int $phoneNumber1;
    private int $phoneNumber2;
    private string $email;

    public function __construct() {
    }

    // private function __construct(?int $customerID = null, ?string $username = null, ?string $password = null) {
    //     $this->username = $username;
    //     $this->password = $password;
    //     $this->customerID = $customerID;
    // }

    // public static function fromCustomerID(int $customerID): static {
    //     $new = new static($customerID);
    //     return $new;
    // }

    // public static function fromCredentials(string $username, string $password): static {
    //     $new = new static(null, $username, $password);
    //     return $new;
    // }
    
    public function setName(string $name) {
        $this->name = $name;
    }
    
    public function getName() {
        return $this->name;
    }
    
    public function setSurname1(string $surname1) {
        $this->surname1 = $surname1;
    }
    
    public function getSurname1() {
        return $this->surname1;
    }
    
    public function setSurname2(string $surname2) {
        $this->surname2 = $surname2;
    }

    public function getSurname2() {
        return $this->surname2;
    }
    
    public function setBirthdate(Datetime $birthdate) {
        $this->birthdate = $birthdate;
    }

    public function getBirthdate() {
        return $this->birthdate;
    }
    
    public function setStreetName(string $streetName) {
        $this->streetName = $streetName;
    }

    public function getStreetName() {
        return $this->streetName;
    }
    
    public function setStreetNumber(int $streetNumber) {
        $this->streetNumber = $streetNumber;
    }

    public function getStreetNumber() {
        return $this->streetNumber;
    }
    
    public function setCityID(string $cityID) {
        $this->cityID = $cityID;
    }

    public function getCityID() {
        return $this->cityID;
    }

    public function setPostalCode(string $postalCode) {
        $this->postalCode = $postalCode;
    }
    
    public function getPostalCode() {
        return $this->postalCode;
    }
    
    public function setProvinceID(string $provinceID) {
        $this->provinceID = $provinceID;
    }

    public function getProvinceID() {
        return $this->provinceID;
    }
    
    public function setCountryID(string $countryID) {
        $this->countryID = $countryID;
    }

    public function getCountryID() {
        return $this->countryID;
    }
    
    public function setPhoneNumber1(string $phoneNumber1) {
        $this->phoneNumber1 = $phoneNumber1;
    }

    public function getPhoneNumber1() {
        return $this->phoneNumber1;
    }
    
    public function setPhoneNumber2(string $phoneNumber2) {
        $this->phoneNumber2 = $phoneNumber2;
    }

    public function getPhoneNumber2() {
        return $this->phoneNumber2;
    }

    public function setEmail(string $email) {
        $this->email = $email;
    }

    public function getEmail() {
        return $this->email;
    }
}