<?php
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
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username">
                    <span class="validation-error <?php ?>"><?php ?></span>
                </div>
                <div class="control-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password">
                </div>
                <div class="control-group">
                    <label for="password-copy">Confirm password</label>
                    <input type="password" name="passwordCopy" id="password-copy">
                </div>
                <div class="control-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name">
                </div>
                <div class="control-group">
                    <label for="surname1">Surname 1</label>
                    <input type="text" name="surname1" id="surname1">
                </div>
                <div class="control-group">
                    <label for="surname2">Surname 2</label>
                    <input type="text" name="surname2" id="surname2">
                </div>
                <div class="control-group">
                    <label for="surname2">Surname 2</label>
                    <input type="text" name="surname2" id="surname2">
                </div>
            </fieldset>
            <button type="submit">New user</button>
        </form>
    </div>
</body>
</html>