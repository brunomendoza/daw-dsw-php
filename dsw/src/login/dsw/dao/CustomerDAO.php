<?php

namespace dsw\dao;

use \dsw\model\Customer;
use \PDO;
use \PDOException;

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
        $res;
        
        try {
            $dbh = new PDO($this->dsn, $this->config['user'], $this->config['pass']);
            $sth = $dbh->prepare($query);
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