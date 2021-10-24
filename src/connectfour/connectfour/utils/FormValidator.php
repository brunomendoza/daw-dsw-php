<?php

namespace connectfour\utils;

use ArrayObject;

class FormValidator {
    private array $formData;

    private static array $fields = array(
        "p1FirstName",
        "p1LastName",
        "p1Address",
        "p1Country",
        "p1Province",
        "p1Age",
        "p1Color",
        "p2FirstName",
        "p2LastName",
        "p2Address",
        "p2Country",
        "p2Province",
        "p2Age",
        "p2Color",
    );

    public function __construct(array $formData) {
        $this->formData = $formData;
    }

    public function validateForm() {
        $isUnavailable = false;
        $field;

        $obj = new ArrayObject(self::$fields);
        $iterator = $obj->getIterator();

        $errorMessages = array();
        
        while (!$isUnavailable && $iterator->valid()) {
            $field = $iterator->current();
            
            if (!array_key_exists($field, $this->formData)) {
                trigger_error(sprintf("%s hasn't been set", $field));
                
                $isUnavailable = true;
            }

            $iterator->next();
        }

        if (!$isUnavailable) {
            foreach ($this->formData as $fieldName => $fieldValue) {
                if (empty($fieldValue)) {
                    $errorMessages[$fieldName] = sprintf("%s can't by empty", $fieldName);
                }
            }

            if (strcmp($this->formData["p1Color"], $this->formData["p2Color"]) == 0) {
                $errorMessages["colorAreEqual"] = "Player color has to be different";
            }
        }

        return $errorMessages;
    }
}