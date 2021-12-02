<?php

namespace dsw\util;
use \Exception;

class Form {
    private static array $requiredFields = array(
        "name",
        "surname1",
        "surname2",
        "birthday",
        "streetName",
        "streetNumber",
        "cityID",
        "provinceID",
        "countryID",
        "phoneNumber1",
        "phoneNumber2"
    );

    private static array $credentialFields = array(
        "username",
        "password"
    );

    public function __construct($fields) {
    }

    public static function validate(array $fields) {
        $obj = new ArrayObject($self::requiredFields);
        $iterator = $obj->getIterator();
        $current;
        $errorMessages = array();

        while ($iterator->valid()) {
            $current = $iterator->current();

            if (!array_key_exists($current, $fields)) {
                throw new Exception(sprintf("%s does not exist", $current), 1);
            }

            $iterator->next();
        }

        foreach (self::$requiredFields as $name) {
            if (empty($fields[$name])) {
                $errorMessages[$name] = sprintf("% is empty", $name);
            }
        }

        return $errorMessages;
    }

    public static function validateCredential(array $fields) {
        $errorMessages = array();

        foreach (self::$credentialFields as $field) {
            if (!array_key_exists($field, $fields)) {
                throw new Exception(sprintf("%s does not exist", $field), 1);
            }

            if (empty($fields[$field])) {
                $errorMessages[$field] = "empty";
            }

            // if (!empty($fields["username"]) && !self::usernameExists($fields["username"])) {
            //     $errorMessages["username"] = "unavailable";
            // }
        }

        return $errorMessages;
    }

    // private static function usernameExists($username) {
    //     $usernameExists = false;
    //     try {
    //         $dbh = new PDO('mysql:host=db;dbname=commercedb', $user, $password);

    //         $value = $dbh->query('SELECT count(*) FROM customer WHERE username = ' . $username);

    //         $username = $value > 0;

    //         $dbh = null;
    //     } catch (\Throwable $th) {
    //         //throw $th;
    //     }

    //     return $usernameExists;
    // }
}

