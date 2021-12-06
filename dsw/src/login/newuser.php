<?php
require_once(__DIR__ . "/dsw/dao/CityDAO.php");
require_once(__DIR__ . "/dsw/dao/ProvinceDAO.php");
require_once(__DIR__ . "/dsw/dao/CountryDAO.php");
require_once(__DIR__ . "/dsw/dao/CustomerDAO.php");
require_once(__DIR__ . "/dsw/model/City.php");
require_once(__DIR__ . "/dsw/model/Province.php");
require_once(__DIR__ . "/dsw/model/Country.php");
require_once(__DIR__ . "/dsw/util/Form.php");
require_once(__DIR__ . "/dsw/model/Customer.php");
require_once(__DIR__ . "/dsw/dto/CustomerDTO.php");

use \dsw\dao\ProvinceDAO;
use \dsw\dao\CityDAO;
use \dsw\dao\CountryDAO;
use \dsw\dao\CustomerDAO;
use \dsw\model\City;
use \dsw\model\Province;
use \dsw\model\Country;
use \dsw\model\Customer;
use \dsw\dto\CustomerDTO;

use \dsw\util\Form;

$cityDao = new CityDAO();
$provinceDao = new ProvinceDAO();
$countryDao = new CountryDAO();
$customerDao = new CustomerDAO();
$errors;
$customerId;

$errors = array();

if (isset($_COOKIE["ckdatauser"])) {
    setcookie("ckdatauser", "", time() - 3600);
}

if ($_SERVER["REQUEST_METHOD"] === 'POST') {
    $errors = Form::validate($_POST);

    if (!(count($errors) > 0)) {
        $customer = new Customer();

        $customer->setUsername($_POST["username"]);
        $customer->setPassword($_POST["password"]);
        $customer->setName($_POST["name"]);
        $customer->setSurname1($_POST["surname1"]);
        $customer->setSurname2($_POST["surname2"] ?? "");
        $customer->setBirthdate(\DateTime::createFromFormat("Y-m-d", $_POST["birthdate"]));
        $customer->setStreetName($_POST["streetName"]);
        $customer->setStreetNumber(isset($_POST["streetNumber"]) ? intval($_POST["streetNumber"]) : -1);
        $customer->setPostalCode(isset($_POST["postalCode"]) ? intval($_POST["postalCode"]) : -1);
        $customer->setCityId(intval($_POST["cityId"]));
        $customer->setProvinceId(intval($_POST["provinceId"]));
        $customer->setCountryId(intval($_POST["countryId"]));
        $customer->setPhoneNumber1(intval($_POST["phoneNumber1"]));
        $customer->setPhoneNumber2(isset($_POST["phoneNumber2"]) ? intval($_POST["phoneNumber1"]) : -1);
        $customer->setEmail($_POST["email"] ?? "");
        $customer->setInsertDate(new DateTime());
        $customer->setUpdateDate(new DateTime());
        
        $customerId = $customerDao->save($customer)->getId();

        setcookie("ckdatauser", $customerId, time() + (24 * 36000));
        session_start();
        $_SESSION["customer"] = json_encode(new CustomerDTO($customer));
        header("Location: home.php");
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DAW &mdash; New user</title>
    <link rel="stylesheet" href="./style.css">
</head>
<body>
    <div class="wrapper">
        <form action="<?php htmlentities($_SERVER["PHP_SELF"]); ?>" method="post">
            <fieldset>
                <legend>New user</legend>
                <div class="control-group">
                    <label for="username">Nombre Usuario</label>
                    <input type="text" name="username" id="username" value="<?php echo isset($_POST["username"]) ? $_POST["username"] : ""; ?>">
                    <span class="error <?php echo key_exists("username", $errors) ? "" : "hidden"; ?>">Nombre de usuario vacio</span>
                    <span class="error <?php echo key_exists("usernameExists", $errors) ? "" : "hidden"; ?>">Nombre de usuario existe</span>
                </div>
                <div class="control-group">
                    <label for="password">Constraseña</label>
                    <input type="password" name="password" id="password" value="<?php echo isset($_POST["password"]) ? $_POST["password"] : ""; ?>">
                    <span class="error <?php echo key_exists("password", $errors) ? "" : "hidden"; ?>">Contraseña vacía</span>
                </div>
                <div class="control-group">
                    <label for="name">Nombre</label>
                    <input type="text" name="name" id="name" value="<?php echo isset($_POST["name"]) ? $_POST["name"] : ""; ?>">
                    <span class="error <?php echo key_exists("name", $errors) ? "" : "hidden"; ?>">Nombre vacío</span>
                </div>
                <div class="control-group">
                    <label for="surname1">Apellido 1</label>
                    <input type="text" name="surname1" id="surname1" value="<?php echo isset($_POST["surname1"]) ? $_POST["surname1"] : ""; ?>">
                    <span class="error <?php echo key_exists("surname1", $errors) ? "" : "hidden"; ?>">Apellido 1 vacío</span>
                </div>
                <div class="control-group">
                    <label for="surname2">Apellido 2</label>
                    <input type="text" name="surname2" id="surname2" value="<?php echo isset($_POST["surname2"]) ? $_POST["surname2"] : ""; ?>">
                </div>
                <div class="control-group">
                    <label for="birthdate">Fecha Nacimiento</label>
                    <input type="date" name="birthdate" id="birthdate" value="<?php echo isset($_POST["birthdate"]) ? $_POST["birthdate"] : ""; ?>">
                    <span class="error <?php echo key_exists("birthdate", $errors) ? "" : "hidden"; ?>">Fecha nacimiento vacío</span>
                </div>
                <div class="control-group">
                    <label for="streetName">Calle</label>
                    <input type="text" name="streetName" id="streetName" value="<?php echo isset($_POST["streetName"]) ? $_POST["streetName"] : ""; ?>">
                    <span class="error <?php echo key_exists("streetName", $errors) ? "" : "hidden"; ?>">Contraseña vacía</span>
                </div>
                <div class="control-group">
                    <label for="streetNumber">Número</label>
                    <input type="number" name="streetNumber" id="streetNumber" value="<?php echo isset($_POST["streetNumber"]) ? $_POST["streetNumber"] : ""; ?>">
                </div>
                <div class="control-group">
                    <label for="postalCode">Código Postal</label>
                    <input type="text" name="postalCode" id="postalCode" value="<?php echo isset($_POST["postalCode"]) ? $_POST["postalCode"] : ""; ?>">
                </div>
                <div class="control-group">
                    <label for="city">Localidad</label>
                    <select name="cityId" id="city">
                        <?php foreach ($cityDao->getAll() as $city): ?>
                            <option value="<?php echo $city->getId(); ?>" <?php echo isset($_POST["cityId"]) && $_POST["cityId"] == $city->getId() ? "selected" : ""; ?>><?php echo $city->getName(); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="control-group">
                    <label for="province">Provincia</label>
                    <select name="provinceId" id="province">
                        <?php foreach ($provinceDao->getAll() as $province): ?>
                            <option value="<?php echo $province->getId(); ?>" <?php echo isset($_POST["provinceId"]) && $_POST["provinceId"] == $province->getId() ? "selected" : ""; ?>><?php echo $province->getName(); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="control-group">
                    <label for="country">País</label>
                    <select name="countryId" id="country">
                        <?php foreach ($countryDao->getAll() as $country): ?>
                            <option value="<?php echo $country->getId(); ?>" <?php echo isset($_POST["countryId"]) && $_POST["countryId"] == $country->getId() ? "selected" : ""; ?>><?php echo $country->getName(); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="control-group">
                    <label for="phonenumber1">Teléfono 1</label>
                    <input type="text" name="phoneNumber1" id="phonenumber1" value="<?php echo isset($_POST["phoneNumber1"]) ? $_POST["phoneNumber1"] : ""; ?>">
                    <span class="error <?php echo key_exists("phoneNumber1", $errors) ? "" : "hidden"; ?>">Número de teléfono vacío</span>
                </div>
                <div class="control-group">
                    <label for="phonenumber2">Teléfono 2</label>
                    <input type="text" name="phoneNumber2" id="phonenumber2" value="<?php echo isset($_POST["phoneNumber2"]) ? $_POST["phoneNumber2"] : ""; ?>">
                </div>
                <div class="control-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" value="<?php echo isset($_POST["email"]) ? $_POST["email"] : ""; ?>">
                </div>
            </fieldset>
            <button type="submit">New user</button>
        </form>
    </div>
</body>
</html>