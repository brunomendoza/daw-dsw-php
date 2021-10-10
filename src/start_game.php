<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Roadrunner</title>
    <link rel="stylesheet" href="./style.css">
</head>
<body>
<h1>Fuck PHP!</h1>
<div class="board">
<?php
require_once("./functions.php");
initializeBoard(5, 5);
?>
</div>
</body>
</html>

