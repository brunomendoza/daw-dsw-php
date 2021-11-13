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
    
    private PDO $db;
    
    private bool $error;
    private string $errorMessage;
    
    public function __construct(string $host, string $dbname, string $user, string $password) {
        $this->host = $host;
        $this->dbname = $dbname;
        $this->user = $user;
        $this->password = $password;
        $this->errorExists = false;
        $this->errorMessage = "";
    }
    
    public function open() {
        $host = sprintf("mysql:host=%s;dbname=%s",$this->host, $this->dbname);

        try { 
            $this->db = new PDO($host, $this->user, $this->password);
            $this->db->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, true);
            $this->db->exec("set names utf8mb4");
        } catch (PDOException $e) {
            $this->error = true;
            $this->errorMessage = $e->getMessage();  
        }
    }
    
   function __destruct() {
        //destructor
    }
    
    public function errorExists() {
        return $this->errorExists;
        
    }
    
    public function errorMessage() {
        return $this->errorMessage;
    }
}
