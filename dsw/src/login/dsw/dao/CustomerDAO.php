<?php

namespace dsw\dao;

use \dsw\model\Customer;
use \PDO;
use \PDOException;
use \DateTime;

class CustomerDAO {
    private string $dsn;
    private array $config;
    
    public function __construct() {
        $this->config = include(__DIR__ . '/../../config.php');
        $this->dsn = sprintf('mysql:host=%s;dbname=%s', $this->config['host'], $this->config['db']);
    }
    
    public function getById(int $customerID) {
        $query = 'SELECT * FROM customer WHERE customerid = :customerID';
        $customer = null;
        $row;
        $provinceDAO = new ProvinceDAO();
        $cityDAO;
        $countryDAO;
        
        try {
            $dbh = new PDO($this->dsn, $this->config['user'], $this->config['pass']);
            $sth = $dbh->prepare($query);
            $sth->bindParam(':customerID', $customerID);
            
            if ($sth->execute()) {
                $row = $sth->fetch();
                
                if ($row) {
                    $customer = new Customer();
                    
                    $customer->setName($row["name"]);
                    $customer->setSurname1($row["firstlastname"]);
                    $customer->setSurname2($row["secondlastname"] ?? "focker");
                    $customer->setBirthdate(DateTime::createFromFormat('Y-m-d', $row['birthdaydate']));
                    $customer->setStreetName($row["streetdirection"]);
                    $customer->setStreetNumber(intval($row["streetnumber"]));
                    $customer->setPostalCode(intval($row["provincecode"] ?? -1));
                    $customer->setProvinceID(intval($row["provinceid"]));
                    $customer->setCityID(intval($row["cityid"]));
                    $customer->setCountryID(intval($row["countryid"]));
                    $customer->setPhoneNumber1(intval($row["telephone1"]));
                    $customer->setPhoneNumber2(intval($row["telephone2"] ?? -1));
                    $customer->setEmail($row["email"]);
                }
            }
            
            $sth = null;
            $dbh = null;
        } catch (PDOException $e) {
            printf("Exception catched: %s", $e->getMessage());
        }
        
        return $customer;
    }
    
    public function save(Customer $customer) {
        $query = "INSERT INTO customer (username, password, name, firstlastname, secondlastname, birthdaydate, streetdirection, streetnumber, provincecode, cityid, provinceid, countryid, telephone1, telephone2, email, insertdate, updatedate) VALUES (:username, :password, :name, :surname1, :surname2, :birthdate, :streetName, :streetNumber, :postalCode, :cityId, :provinceId, :countryId, :phoneNumber1, :phoneNumber2, :email, :insertDate, :updateDate)";

        try {
            $dbh = new PDO($this->dsn, $this->config['user'], $this->config['pass']);
            $sth = $dbh->prepare($query);

            $_username = $customer->getUsername();
            $_password = $customer->getPassword();
            $_name = $customer->getName();
            $_surname1 = $customer->getSurname1();
            $_surname2 = $customer->getSurname2();
            $_birthdate = $customer->getBirthdate()->format("c");
            $_streetName = $customer->getStreetName();
            $_streetNumber = $customer->getStreetNumber();
            $_postalCode = $customer->getPostalCode();
            $_cityId = $customer->getCityId();
            $_provinceId = $customer->getProvinceId();
            $_countryId = $customer->getCountryId();
            $_phoneNumber1 = $customer->getPhoneNumber1();
            $_phoneNumber2 = $customer->getPhoneNumber2();
            $_email = $customer->getEmail();
            $_insertDate = $customer->getInsertDate()->format("c");
            $_updateDate = $customer->getUpdateDate()->format("c");

            $sth->bindParam(':username', $_username, PDO::PARAM_STR);
            $sth->bindParam(':password', $_password);
            $sth->bindParam(':name', $_name);
            $sth->bindParam(':surname1', $_surname1);
            $sth->bindParam(':surname2', $_surname2);
            $sth->bindParam(':birthdate', $_birthdate);
            $sth->bindParam(':streetName', $_streetName);
            $sth->bindParam(':streetNumber', $streetNumber);
            $sth->bindParam(':postalCode', $_postalCode);
            $sth->bindParam(':cityId', $_cityId);
            $sth->bindParam(':provinceId', $_provinceId);
            $sth->bindParam(':countryId', $_countryId);
            $sth->bindParam(':phoneNumber1', $_phoneNumber1);
            $sth->bindParam(':phoneNumber2', $_phoneNumber2);
            $sth->bindParam(':email', $_email);
            $sth->bindParam(':insertDate', $_insertDate);
            $sth->bindParam(':updateDate', $_updateDate);

            if ($sth->execute()) {
                $customer->setId(intval($dbh->lastInsertId("customer")));
            }
            
            $sth = null;
            $dbh = null;

            return $customer;
        } catch (PDOException $e) {
            printf("Customer: Exception catched: %s", $e->getMessage());
        }

        return null;
    }
    
    public function authenticate(string $username, string $password) {
        $customerID = -1;
        $result;

        try {
            $dbh = new PDO($this->dsn, $this->config['user'], $this->config['pass']);
            $query = 'SELECT customerid FROM customer WHERE username=:username AND password=:password';
    
            $sth = $dbh->prepare($query);
            
            $sth->bindParam('username', $username);
            $sth->bindParam('password', $password);

            if ($sth->execute()) {
                $result = $sth->fetch();

                if ($result) {
                    $customerID = $result['customerid'];
                }
            }

            $sth = null;
            $dbh = null;
        } catch (\Throwable $th) {
            printf("Exception catched: %s", $th->getMessage());
        }
        
        return $customerID;
    } 
    
    public function exists(string $username) {
        $dbh = new PDO($this->dsn, $this->config['user'], $this->config['pass']);
        $exists = false;
        $query = "SELECT count(*) FROM customer WHERE username = ?";
        
        try {
            $sth = $dbh->prepare($query);

            if ($sth->execute([$username])) {
                // Row and cell
                if ($sth->fetchAll()[0][0] > 0) {
                    $exists = true;
                }
            }

            $sth = null;
            $dbh = null;
        } catch (\PDOException $e) {
            printf("Exception catched: %s", e.getMessage());
        }

        return $exists;
    }
}