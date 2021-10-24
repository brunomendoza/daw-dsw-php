<?php

require_once("connectfour/utils/FormValidator.php");
use connectfour\utils\FormValidator;

$errorMessages;
$formValidator;

$isPostRequest = $_SERVER["REQUEST_METHOD"] == "POST";

if ($isPostRequest) {
    $formValidator = new FormValidator($_POST);
    $errorMessages = $formValidator->validateForm();

    if (count($errorMessages) == 0) {
    }
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
                    <input type="text" name="p1FirstName" id="p1-first-name" value="<?php echo $isPostRequest ? $_POST["p1FirstName"] : ""; ?>"/>
                    <span class="<?php echo !empty($errorMessages["p1FirstName"]) ? "error__message" : "hidden"; ?>">
                        <?php echo !empty($errorMessages["p1FirstName"]) ? $errorMessages["p1FirstName"] : "&nbsp;"; ?>
                    </span> 
                </div>
                <div class="control__group">
                    <label for="p1-last-name">Last Name</label>
                    <input type="text" name="p1LastName" id="p1-last-name" value="<?php echo $isPostRequest ? $_POST["p1LastName"] : ""; ?>" />
                    <span class="<?php echo !empty($errorMessages["p1LastName"]) ? "error__message" : "hidden"; ?>">
                        <?php echo !empty($errorMessages["p1LastName"]) ? $errorMessages["p1LastName"] : "&nbsp;"; ?>
                    </span> 
                </div>
                <div class="control__group">
                    <label for="p1-address">Address</label>
                    <input type="text" name="p1Address" id="p1-address" value="<?php echo $isPostRequest ? $_POST["p1Address"] : ""; ?>" />
                    <span class="<?php echo !empty($errorMessages["p1Address"]) ? "error__message" : "hidden"; ?>">
                        <?php echo !empty($errorMessages["p1Address"]) ? $errorMessages["p1Address"] : "&nbsp;"; ?>
                    </span> 
                </div>
                <div class="control__group">
                    <label for="p1-province">Province</label>
                    <select name="p1Province" id="p1-province">
                        <option value="a" <?php echo $isPostRequest && $_POST["p1Province"] == "a" ? "selected" : ""; ?>>a</option>
                        <option value="b" <?php echo $isPostRequest && $_POST["p1Province"] == "b" ? "selected" : ""; ?>>b</option>
                        <option value="c" <?php echo $isPostRequest && $_POST["p1Province"] == "c" ? "selected" : ""; ?>>c</option>
                    </select>
                    <span class="<?php echo !empty($errorMessages["p1Province"]) ? "error__message" : "hidden"; ?>">
                        <?php echo !empty($errorMessages["p1Province"]) ? $errorMessages["p1Province"] : "&nbsp;"; ?>
                    </span> 
                </div>
                <div class="control__group">
                    <label for="p1-country">Country</label>
                    <select name="p1Country" id="p1-country">
                        <option value="a" <?php echo $isPostRequest && $_POST["p1Country"] == "a" ? "selected" : ""; ?>>a</option>
                        <option value="b" <?php echo $isPostRequest && $_POST["p1Country"] == "b" ? "selected" : ""; ?>>b</option>
                        <option value="c" <?php echo $isPostRequest && $_POST["p1Country"] == "c" ? "selected" : ""; ?>>c</option>
                    </select>
                    <span class="<?php echo !empty($errorMessages["p1Country"]) ? "error__message" : "hidden"; ?>">
                        <?php echo !empty($errorMessages["p1Country"]) ? $errorMessages["p1Country"] : "&nbsp;"; ?>
                    </span> 
                </div>
                <div class="control__group">
                    <label for="p1-age">Age</label>
                    <select name="p1Age" id="p1-age">
                        <option value="a" <?php echo $isPostRequest && $_POST["p1Age"] == "a" ? "selected" : ""; ?>>0-20</option>
                        <option value="b" <?php echo $isPostRequest && $_POST["p1Age"] == "b" ? "selected" : ""; ?>>20-60</option>
                        <option value="c" <?php echo $isPostRequest && $_POST["p1Age"] == "c" ? "selected" : ""; ?>>60+</option>
                    </select>
                    <span class="<?php echo !empty($errorMessages["p1Age"]) ? "error__message" : "hidden"; ?>">
                        <?php echo !empty($errorMessages["p1Age"]) ? $errorMessages["p1Age"] : "&nbsp;"; ?>
                    </span> 
                </div>
                <div class="control__group">
                    <label for="p1-color">
                        Red
                        <input type="radio" name="p1Color" id="p1-color-red" value="red" <?php echo $isPostRequest && $_POST["p1Color"] == "red" ? "checked" : ""; ?>>
                    </label>
                    <label for="last-name">
                        Blue
                        <input type="radio" name="p1Color" id="p1-color-blue" value="blue" <?php echo $isPostRequest && $_POST["p1Color"] == "blue" ? "checked" : ""; ?>>
                    </label>
                    <span class="<?php echo !empty($errorMessages["p1Color"]) ? "error__message" : "hidden"; ?>">
                        <?php echo !empty($errorMessages["p1Color"]) ? $errorMessages["p1Color"] : "&nbsp;"; ?>
                    </span> 
                    <span class="<?php echo !empty($errorMessages["colorAreEqual"]) ? "error__message" : "hidden"; ?>">
                        <?php echo !empty($errorMessages["colorAreEqual"]) ? $errorMessages["colorAreEqual"] : "&nbsp;"; ?>
                    </span> 
                </div>
            </fieldset>
            <fieldset>
                <legend>Player 2</legend>
                <div class="control__group">
                    <label for="p2-first-name">First Name</label>
                    <input type="text" name="p2FirstName" id="p2-first-name" value="<?php echo $isPostRequest ? $_POST["p2FirstName"] : ""; ?>"/>
                    <span class="<?php echo !empty($errorMessages["p2FirstName"]) ? "error__message" : "hidden"; ?>">
                        <?php echo !empty($errorMessages["p2FirstName"]) ? $errorMessages["p2FirstName"] : "&nbsp;"; ?>
                    </span> 
                </div>
                <div class="control__group">
                    <label for="p2-last-name">Last Name</label>
                    <input type="text" name="p2LastName" id="p2-last-name" value="<?php echo $isPostRequest ? $_POST["p2LastName"] : ""; ?>" />
                    <span class="<?php echo !empty($errorMessages["p2LastName"]) ? "error__message" : "hidden"; ?>">
                        <?php echo !empty($errorMessages["p2LastName"]) ? $errorMessages["p2LastName"] : "&nbsp;"; ?>
                    </span> 
                </div>
                <div class="control__group">
                    <label for="p2-address">Address</label>
                    <input type="text" name="p2Address" id="p2-address" value="<?php echo $isPostRequest ? $_POST["p2Address"] : ""; ?>" />
                    <span class="<?php echo !empty($errorMessages["p2Address"]) ? "error__message" : "hidden"; ?>">
                        <?php echo !empty($errorMessages["p2Address"]) ? $errorMessages["p2Address"] : "&nbsp;"; ?>
                    </span> 
                </div>
                <div class="control__group">
                    <label for="p2-province">Province</label>
                    <select name="p2Province" id="p2-province">
                        <option value="a" <?php echo $isPostRequest && $_POST["p2Province"] == "a" ? "selected" : ""; ?>>a</option>
                        <option value="b" <?php echo $isPostRequest && $_POST["p2Province"] == "b" ? "selected" : ""; ?>>b</option>
                        <option value="c" <?php echo $isPostRequest && $_POST["p2Province"] == "c" ? "selected" : ""; ?>>c</option>
                    </select>
                    <span class="<?php echo !empty($errorMessages["p2Province"]) ? "error__message" : "hidden"; ?>">
                        <?php echo !empty($errorMessages["p2Province"]) ? $errorMessages["p2Province"] : "&nbsp;"; ?>
                    </span> 
                </div>
                <div class="control__group">
                    <label for="p2-country">Country</label>
                    <select name="p2Country" id="p2-country">
                        <option value="a" <?php echo $isPostRequest && $_POST["p2Country"] == "a" ? "selected" : ""; ?>>a</option>
                        <option value="b" <?php echo $isPostRequest && $_POST["p2Country"] == "b" ? "selected" : ""; ?>>b</option>
                        <option value="c" <?php echo $isPostRequest && $_POST["p2Country"] == "c" ? "selected" : ""; ?>>c</option>
                    </select>
                    <span class="<?php echo !empty($errorMessages["p2Country"]) ? "error__message" : "hidden"; ?>">
                        <?php echo !empty($errorMessages["p2Country"]) ? $errorMessages["p2Country"] : "&nbsp;"; ?>
                    </span> 
                </div>
                <div class="control__group">
                    <label for="p2-age">Age</label>
                    <select name="p2Age" id="p2-age">
                        <option value="a" <?php echo $isPostRequest && $_POST["p2Age"] == "a" ? "selected" : ""; ?>>0-20</option>
                        <option value="b" <?php echo $isPostRequest && $_POST["p2Age"] == "b" ? "selected" : ""; ?>>20-60</option>
                        <option value="c" <?php echo $isPostRequest && $_POST["p2Age"] == "c" ? "selected" : ""; ?>>60+</option>
                    </select>
                    <span class="<?php echo !empty($errorMessages["p2Age"]) ? "error__message" : "hidden"; ?>">
                        <?php echo !empty($errorMessages["p2Age"]) ? $errorMessages["p2Age"] : "&nbsp;"; ?>
                    </span> 
                </div>
                <div class="control__group">
                    <label for="p2-color">
                        Red
                        <input type="radio" name="p2Color" id="p2-color-red" value="red" <?php echo $isPostRequest && $_POST["p2Color"] == "red" ? "checked" : ""; ?>>
                    </label>
                    <label for="last-name">
                        Blue
                        <input type="radio" name="p2Color" id="p2-color-blue" value="blue" <?php echo $isPostRequest && $_POST["p2Color"] == "blue" ? "checked" : ""; ?>>
                    </label>
                    <span class="<?php echo !empty($errorMessages["p2Color"]) ? "error__message" : "hidden"; ?>">
                        <?php echo !empty($errorMessages["p2Color"]) ? $errorMessages["p2Color"] : "&nbsp;"; ?>
                    </span> 
                    <span class="<?php echo !empty($errorMessages["colorAreEqual"]) ? "error__message" : "hidden"; ?>">
                        <?php echo !empty($errorMessages["colorAreEqual"]) ? $errorMessages["colorAreEqual"] : "&nbsp;"; ?>
                    </span> 
                </div>
            </fieldset>
            <button type="submit">Jugar</button>
        </form>
    </div>
</body>
</html>