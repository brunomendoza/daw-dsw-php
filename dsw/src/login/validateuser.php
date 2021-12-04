<?php

require_once(__DIR__ . '/dsw/dao/CustomerDAO.php');
use dsw\dao\CustomerDAO;
require_once(__DIR__ . '/dsw/dao/CityDAO.php');
use dsw\dao\CityDAO;
require_once(__DIR__ . '/dsw/dao/ProvinceDAO.php');
use dsw\dao\ProvinceDAO;
require_once(__DIR__ . '/dsw/dao/CountryDAO.php');
use dsw\dao\CountryDAO;

require_once(__DIR__ . '/dsw/model/Customer.php');
use dsw\model\Customer;
require_once(__DIR__ . '/dsw/model/Province.php');
use dsw\model\Province;
require_once(__DIR__ . '/dsw/model/City.php');
use dsw\model\City;
require_once(__DIR__ . '/dsw/model/Country.php');
use dsw\model\Country;

require_once(__DIR__ . '/dsw/dto/CustomerDTO.php');
use dsw\dto\CustomerDTO;

require_once("dsw/util/Form.php");
use dsw\util\Form;

$errorMessages = array();
$customerID;
$provinceDAO = new ProvinceDAO();
$countryDAO = new CountryDAO();
$cityDAO = new CityDAO();
$customerDAO = new CustomerDAO();
$customerDto;
$result;

if (isset($_COOKIE["ckdatauser"])) {
    $customerID = htmlspecialchars($_COOKIE["ckdatauser"]);
    $customer = $customerDAO->getByID($customerID);
    $province = $provinceDAO->getById($customer->getProvinceID());
    $city = $cityDAO->getById($customer->getCityID());
    $country = $countryDAO->getById($customer->getCountryID());

    $customerDto = new CustomerDTO(
        $customer->getName(),
        $customer->getSurname1(),
        $customer->getSurname2(),
        $customer->getBirthdate(),
        $customer->getStreetName(),
        $customer->getStreetNumber(),
        $customer->getPostalCode(),
        $city->getName(),
        $province->getName(),
        $country->getName(),
        $customer->getPhoneNumber1(),
        $customer->getPhoneNumber2(),
        $customer->getEmail(),
    );

    session_start();
    $_SESSION["customer"] = json_encode($customerDto);

    header("Location: home.php");
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
            if (isset($_COOKIE["ckdatauser"])) {
                setcookie('ckdatauser', '', time() - 3600);
            }

            foreach ($errorMessages as $fieldName => $errorType) {
                $queryStrings .= sprintf("&%s=%s", $fieldName, $errorType);
            }

            header(sprintf("Location: index.php?%s", substr($queryStrings, 1)));
        } else {
            $customerID = $customerDAO->authenticate($_POST["username"], $_POST["password"]); 
            if ($customerID >= 0) {
                setcookie('ckdatauser', $customerID, time() + (3600 * 24));

                $customer = $customerDAO->getByID($customerID);
                $province = $provinceDAO->getById($customer->getProvinceID());
                $city = $cityDAO->getById($customer->getCityID());
                $country = $countryDAO->getById($customer->getCountryID());
            
                $customerDto = new CustomerDTO(
                    $customer->getName(),
                    $customer->getSurname1(),
                    $customer->getSurname2(),
                    $customer->getBirthdate(),
                    $customer->getStreetName(),
                    $customer->getStreetNumber(),
                    $customer->getPostalCode(),
                    $city->getName(),
                    $province->getName(),
                    $country->getName(),
                    $customer->getPhoneNumber1(),
                    $customer->getPhoneNumber2(),
                    $customer->getEmail(),
                );

                session_start();
                $_SESSION['customer'] = json_encode($customerDto);

                header("Location: home.php");
            } else {
                header("Location: index.php?authentication=fail");
            }
        }
    }
}
