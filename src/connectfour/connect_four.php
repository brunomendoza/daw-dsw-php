<?php

require_once("connectfour/utils/FormValidator.php");
use connectfour\utils\FormValidator;

$errorMessages;
$formValidator;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $formValidator = new FormValidator($_POST);
    $errorMessages = $formValidator->validateForm();

    var_dump($errorMessages);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connect Four &mdash; Game</title>
    <link rel="stylesheet" href="./../style.css">
</head>
<body>
    <div class="connectfour__wrapper">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <fieldset>
                <legend>Player 1</legend>
                <div class="control__group">
                    <label for="p1-first-name">First Name</label>
                    <input type="text" name="p1FirstName" id="p1-first-name" />
                </div>
                <div class="control__group">
                    <label for="p1-last-name">Last Name</label>
                    <input type="text" name="p1LastName" id="p1-last-name" />
                </div>
                <div class="control__group">
                    <label for="p1-address">Address</label>
                    <input type="text" name="p1Address" id="p1-address" />
                </div>
                <div class="control__group">
                    <label for="p1-province">Province</label>
                    <select name="p1Province" id="p1-province">
                        <option value="a">a</option>
                        <option value="b">b</option>
                        <option value="c">c</option>
                    </select>
                </div>
                <div class="control__group">
                    <label for="p1-country">Country</label>
                    <select name="p1Country" id="p1-country">
                        <option value="a">a</option>
                        <option value="b">b</option>
                        <option value="c" default>c</option>
                    </select>
                </div>
                <div class="control__group">
                    <label for="p1-age">Age</label>
                    <select name="p1Age" id="p1-age">
                        <option value="a">0-20</option>
                        <option value="b">20-60</option>
                        <option value="c">60-</option>
                    </select>
                </div>
                <div class="control__group">
                    <label for="p1-color">
                        Red
                        <input type="radio" name="p1Color" id="p1-color-red" value="red">
                    </label>
                    <label for="last-name">
                        Blue
                        <input type="radio" name="p1Color" id="p1-color-blue" value="blue" checked>
                    </label>
                </div>
            </fieldset>
            <fieldset>
                <legend>Player 2</legend>
                <div class="control__group">
                    <label for="p2-first-name">First Name</label>
                    <input type="text" name="p2FirstName" id="p2-first-name" />
                </div>
                <div class="control__group">
                    <label for="p2-last-name">Last Name</label>
                    <input type="text" name="p2LastName" id="p2-last-name" />
                </div>
                <div class="control__group">
                    <label for="p2-address">Address</label>
                    <input type="text" name="p2Address" id="p2-address" />
                </div>
                <div class="control__group">
                    <label for="p2-province">Province</label>
                    <select name="p2Province" id="p2-province">
                        <option value="a">a</option>
                        <option value="b">b</option>
                        <option value="c">c</option>
                    </select>
                </div>
                <div class="control__group">
                    <label for="p2-country">Country</label>
                    <select name="p2Country" id="p2-country">
                        <option value="a">a</option>
                        <option value="b">b</option>
                        <option value="c" default>c</option>
                    </select>
                </div>
                <div class="control__group">
                    <label for="p2-age">Age</label>
                    <select name="p2Age" id="p2-age">
                        <option value="a">0-20</option>
                        <option value="b">20-60</option>
                        <option value="c">60-</option>
                    </select>
                </div>
                <div class="control__group">
                    <label for="p2-color-red">
                        Red
                        <input type="radio" name="p2Color" id="p2-color-red" value="red" checked>
                    </label>
                    <label for="p2-color-blue">
                        Blue
                        <input type="radio" name="p2Color" id="p2-color-blue" value="blue">
                    </label>
                </div>
            </fieldset>
            <button type="submit">Jugar</button>
        </form>
    </div>
</body>
</html>