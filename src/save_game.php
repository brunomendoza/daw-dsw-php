<?php

$cookieName = "acme_game";
session_start();

if (isset($_SESSION[$cookieName])) {
    setcookie($cookieName, $_SESSION[$cookieName], time() + 24 * 60 * 60);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ACME &mdash; Game</title>
</head>
<body>
    <div class="acme__wrapper">
        <p>La animación se ha guardado correctamente</p>
        <a href="./index.php">Volver</a>
    </div>
</body>
</html>