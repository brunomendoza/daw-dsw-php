<?php

if (isset($_COOKIE["ckdatauser"])) {
    header("Location: http://localhost:8080/validateuser.php");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DSW &mdash; Login</title>
    <link rel="stylesheet" href="./style.css">
</head>
<body>
    <div class="wrapper">
        <form action="validateuser.php" method="post">
            <fieldset>
                <legend>Login</legend>
                <?php if (isset($_GET["authentication"])): ?>
                    <span class="error <?php $_GET["authentication"] === "fail" ? "" : "hidden"; ?>">Authentication failed</span>
                <?php endif; ?>
                <div class="control-group">
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" value="<?php echo isset($_GET["previoususername"]) ? $_GET["previoususername"] : ""; ?>">
                    <?php if (isset($_GET["username"])): ?>
                        <span class="error <?php $_GET["username"] === "empty" ? "" : "hidden"; ?>">Username can't be empty</span>
                    <?php endif; ?>
                    <?php if (isset($_GET["usernameexists"])): ?>
                        <span class="error <?php $_GET["usernameexists"] === "unavailable" ? "" : "hidden"; ?>">Username doesn't exist</span>
                    <?php endif; ?>
                </div>
                <div class="control-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" value="<?php echo isset($_GET["previouspassword"]) ? $_GET["previouspassword"] : ""; ?>">
                    <?php if (isset($_GET["password"])): ?>
                        <span class="error <?php $_GET["password"] === "empty" ? "" : "hidden"; ?>">Password can't be empty</span>
                    <?php endif; ?>
                </div>
            </fieldset>
            <button type="submit">Log in</button>
        </form>
        <div>
            <a href="newuser.php">Crear usuario</a>
        </div>
    </div>
</body>
</html>