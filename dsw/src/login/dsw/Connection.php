<?php

namespace dsw;

use \PDO, PDOException;

/**
 * Description of ClsConexion (borrador)
 *
 * @author Daniel P., Bruno Mendoza
 */
class Connection {
    private string $host;
    private string $user;
    private string $password;
    
    private PDO $dbh;
    
    private bool $errorExists;
    private string $errorMessage;
    
    public function __construct(string $host, string $dbname, string $user, string $password) {
        $this->host = $host;
        $this->dbname = $dbname;
        $this->user = $user;
        $this->password = $password;
        $this->errorExists = false;
        $this->errorMessage = "";

        $this->open();
    }
    
    private function open() {
        $host = sprintf("mysql:host=%s;dbname=%s",$this->host, $this->dbname);

        try { 
            $this->dbh = new PDO($host, $this->user, $this->password);
            $this->dbh->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, true);
            $this->dbh->exec("set names utf8mb4");
        } catch (PDOException $e) {
            $this->errorExists = true;
            $this->errorMessage = $e->getMessage();  
        }
    }
    
    function __destruct() {
    }
    
    public function errorExists() {
        return $this->errorExists;
    }
    
    public function getErrorMessage() {
        return $this->errorMessage;
    }

    function getCustomerById(int $customerID) {

    }

    function isAuthenticated(string $username, string $password) {

    }
}
