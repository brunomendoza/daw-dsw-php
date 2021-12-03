<?php

require_once(__DIR__ . '/dsw/dao/CustomerDAO.php');
use dsw\dao\CustomerDAO;

require_once("dsw/util/Form.php");
use dsw\util\Form;

$errorMessages = array();
$customer_id;
$customerDAO = new CustomerDAO();
$result;

if (isset($_COOKIE["ckdatauser"])) {
    $customer_id = htmlspecialchars($_COOKIE["ckdatauser"]);
} else {
    if ($_SERVER["REQUEST_METHOD"] ===  "POST") {
        $fields = ["username", "password"];
        
        $errorMessages = Form::validateCredential($_POST);
        $queryStrings = "";

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

            header(sprintf("Location: index.php?%s", substr($queryStrings, 1)));
        } else {
            $result = $customerDAO->authenticate($_POST["username"], $_POST["password"]); 
            if ($result >= 0) {
                print("Yeah!" . $result);
            } else {
                header("Location: index.php?authentication=fail");
            }
        }
    }
}
