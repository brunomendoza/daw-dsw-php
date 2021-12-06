<?php

namespace dsw\util;

use \Exception;
use \PDO, PDOException;
use \dsw\dao\CustomerDAO;
use \ArrayObject;

class Form {
    private static array $requiredFields = array(
        "username",
        "password",
        "name",
        "surname1",
        "birthdate",
        "streetName",
        "streetNumber",
        "cityId",
        "provinceId",
        "countryId",
        "phoneNumber1",
    );

    private static array $credentialFields = array(
        "username",
        "password"
    );

    public function __construct() {
    }

    public static function validate(array $fields) {
        $obj = new ArrayObject(self::$requiredFields);
        $iterator = $obj->getIterator();
        $current;
        $errorMessages = array();

        $customerDao = new customerDAO();

        while ($iterator->valid()) {
            $current = $iterator->current();

            if (!array_key_exists($current, $fields)) {
                throw new Exception(sprintf("%s does not exist", $current), 1);
            }

            $iterator->next();
        }

        foreach (self::$requiredFields as $name) {
            if (empty($fields[$name])) {
                $errorMessages[$name] = sprintf("%s is empty", $name);
            }
        }

        if (!empty($fields["username"]) && $customerDao->exists($fields["username"])) {
            $errorMessages["usernameExists"] = "true";
        }

        return $errorMessages;
    }

    public static function validateCredential(array $fields) {
        $errorMessages = array();
        $customerDAO = new CustomerDAO();

        foreach (self::$credentialFields as $field) {
            if (!array_key_exists($field, $fields)) {
                throw new Exception(sprintf("%s does not exist", $field), 1);
            }

            if (empty($fields[$field])) {
                $errorMessages[$field] = "empty";
            }
        }

        if (empty($fields["username"]) || !$customerDAO->exists($fields["username"])) {
            $errorMessages["usernameexists"] = "unavailable";
        }
            
        return $errorMessages;
    }
}

