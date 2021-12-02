<?php

namespace dsw\dao;

use \dsw\model\Customer;
use \PDO;
use \PDOException;

class CustomerDAO {
    private PDO $dbh; 

    public function __construct(PDO $dbh) {
        $this->dbh = $dbh;
    }

    public function getCustomerById(int $customerID) {
        $query = 'SELECT * FROM customer WHERE customerid = :customerID';
        $customer = null;
        $res;
        
        try {
            $sth = $this->dbh->prepare($query);
            $sth->bindParam(':customerID', $customerID);

            if ($sth->execute()) {
                $res = $sth->fetchAll();

                if (count($res) > 0) {
                    $row = $res[0];
                    $customer = new Customer();

                    $customer->setName($row["name"]);
                    $customer->setSurname1($row["firstlastname"]);
                    $customer->setSurname2($row["secondlastname"]);
                    $customer->setStreetName($row["streetdirection"]);
                    $customer->setStreetNumber(intval($row["streetnumber"]));
                }
            }
        } catch (PDOException $e) {
            printf("Exception catched: %s", $e->getMessage());
        }

        return $customer;
    }

    public function saveCustomer(Customer $customer) {
        $query = "INSERT INTO customer (name) VALUES ()";
    }

    public function authenticateCustomer(string $username, string $password) {
    } 

    public function usernameExists(string $username) {
        $exists = false;
        $query = "SELECT count(*) FROM customer WHERE username = ?";
        
        try {
            $sth = $this->dbh->prepare($query);

            if ($sth->execute([$username])) {
                if (count($sth->fetchAll() > 0)) {
                    $exists = true;
                }
            }
        } catch (\PDOException $e) {
            printf("Exception catched: %s", e.getMessage());
        }

        return exists;
    }
}