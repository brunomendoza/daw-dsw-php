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
        $query = "INSERT INTO customer (name) VALUES ()";
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