<?php

require_once("dsw/Connection.php");
use dsw\Connection;

// use \PDO;   
// use \PDOException;

require_once("dsw/util/Form.php");
use dsw\util\Form;

require_once("dsw/dao/CustomerDAO.php");
use dsw\dao\CustomerDAO;

$errorMessages = array();
$connection = new Connection("db", "commercedb", "dsw", "dsw");

$customer_id;

if (isset($_COOKIE["ckdatauser"])) {
    $customer_id = htmlspecialchars($_COOKIE["ckdatauser"]);
} else {
    if ($_SERVER["REQUEST_METHOD"] ===  "POST") {
        try {
            $fields = ["username", "password"];
            
            $errorMessages = Form::validateCredential($_POST);
            $queryStrings = "";
    
            if (isset($_POST["username"])) {

                $userExists = $connection->userExists($_POST["username"]);
        
                if (!$userExists) {
                    $queryStrings .= sprintf("&userexists=%s", $userExists);
                    echo($userExists);
                }
            }
    
            // Return form previous values
            foreach ($fields as $field) {
                if (isset($_POST[$field])) {
                    $queryStrings .= sprintf("&previous%s=%s", $field, $_POST[$field]);
                }
            }
    
            // Return form errors
            if (count($errorMessages) > 0) {
                foreach ($errorMessages as $fieldName => $errorType) {
                    $queryStrings .= sprintf("&%s=%s", $fieldName, $errorType);
                }
    
                // header(sprintf("Location: index.php?%s", substr($queryStrings, 1)));
            }
        } catch (e) {
            printf("Exception catched: %s", e.getMessage());
        }
    }
}
