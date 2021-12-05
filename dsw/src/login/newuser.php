<?php
require_once(__DIR__ . "/dsw/dao/CityDAO.php");
require_once(__DIR__ . "/dsw/dao/ProvinceDAO.php");
require_once(__DIR__ . "/dsw/dao/CountryDAO.php");
require_once(__DIR__ . "/dsw/model/City.php");
require_once(__DIR__ . "/dsw/model/Province.php");
require_once(__DIR__ . "/dsw/model/Country.php");

use \dsw\dao\ProvinceDAO;
use \dsw\dao\CityDAO;
use \dsw\dao\CountryDAO;
use \dsw\model\City;
use \dsw\model\Province;
use \dsw\model\Country;

$cityDao = new CityDAO();
$provinceDao = new ProvinceDAO();
$countryDao = new CountryDAO();

if (isset($_COOKIE["ckdatauser"])) {
    setcookie("ckdatauser", "", time() - 3600);
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
        <form action="<?php htmlentities($_SERVER["PHP_SELF"]); ?>">
            <fieldset>
                <legend>New user</legend>
                <div class="control-group">
                    <label for="username">Nombre Usuario</label>
                    <input type="text" name="username" id="username">
                    <span class="validation-error <?php ?>"><?php ?></span>
                </div>
                <div class="control-group">
                    <label for="password">Constraseña</label>
                    <input type="password" name="password" id="password">
                </div>
                <div class="control-group">
                    <label for="name">Nombre</label>
                    <input type="text" name="name" id="name">
                </div>
                <div class="control-group">
                    <label for="surname1">Apellido 1</label>
                    <input type="text" name="surname1" id="surname1">
                </div>
                <div class="control-group">
                    <label for="surname2">Apellido 2</label>
                    <input type="text" name="surname2" id="surname2">
                </div>
                <div class="control-group">
                    <label for="birthdate">Fecha Nacimiento</label>
                    <input type="date" name="birthdate" id="birthdate">
                </div>
                <div class="control-group">
                    <label for="streetName">Calle</label>
                    <input type="text" name="streetName" id="streetName">
                </div>
                <div class="control-group">
                    <label for="streetNumber">Número</label>
                    <input type="number" name="streetNumber" id="streetNumber">
                </div>
                <div class="control-group">
                    <label for="postalCode">Código Postal</label>
                    <input type="text" name="postalCode" id="postalCode">
                </div>
                <div class="control-group">
                    <label for="city">Localidad</label>
                    <select name="cityId" id="city">
                        <?php foreach ($cityDao->getAll() as $city): ?>
                            <option value="<?php echo $city->getId(); ?>"><?php echo $city->getName(); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="control-group">
                    <label for="province">Provincia</label>
                    <select name="provinceId" id="province">
                        <?php foreach ($provinceDao->getAll() as $province): ?>
                            <option value="<?php echo $province->getId(); ?>"><?php echo $province->getName(); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="control-group">
                    <label for="country">País</label>
                    <select name="countryId" id="country">
                        <?php foreach ($countryDao->getAll() as $country): ?>
                            <option value="<?php echo $country->getId(); ?>"><?php echo $country->getName(); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="control-group">
                    <label for="phonenumber1">Teléfono 1</label>
                    <input type="text" name="phoneNumber1" id="phonenumber1">
                </div>
                <div class="control-group">
                    <label for="phonenumber2">Teléfono 2</label>
                    <input type="text" name="phoneNumber2" id="phonenumber2">
                </div>
                <div class="control-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email">
                </div>
            </fieldset>
            <button type="submit">New user</button>
        </form>
    </div>
</body>
</html>