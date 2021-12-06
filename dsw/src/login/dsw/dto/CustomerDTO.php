<?php

namespace dsw\dto;

require_once(__DIR__ . "/../model/Customer.php");
require_once(__DIR__ . "/../dao/CityDAO.php");
require_once(__DIR__ . "/../dao/ProvinceDAO.php");
require_once(__DIR__ . "/../dao/CountryDAO.php");

use \dsw\model\Customer;
use \dsw\dao\{CityDAO, ProvinceDAO, CountryDAO};

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

    public function __construct(Customer $customer) {
        self::initialize($customer);
    }
    
    private function initialize($customer) {
        $cityDao = new CityDAO();
        $provinceDao = new ProvinceDAO();
        $countryDao = new CountryDAO();
        
        $this->surname1 = $customer->getSurname1();
        $this->surname2 = $customer->getSurname2();
        $this->birthdate = $customer->getBirthdate();
        $this->streetName = $customer->getStreetName();
        $this->streetNumber = $customer->getStreetNumber();
        $this->postalCode = $customer->getPostalCode();
        $this->phoneNumber1 = $customer->getPhoneNumber1();
        $this->phoneNumber2 = $customer->getPhoneNumber2();
        $this->email = $customer->getEmail();
        
        $this->city = $cityDao->getById($customer->getCityId())->getName();
        $this->province = $provinceDao->getById($customer->getProvinceId())->getName();
        $this->country = $countryDao->getById($customer->getCountryId())->getName();
        $this->name = $customer->getName();
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