<?php

require_once("functions.php");
require_once("connectfour/model/Player.php");
use connectfour\model\Player;

$connectFourCookieName = "connectfour";
$turnCookieName = "connectfour_turn";

$players;
$player1;
$player2;

session_start();

if (isset($_SESSION[$turnCookieName])) {
    $_SESSION[$turnCookieName] = ($_SESSION[$turnCookieName] == 0) ? 1 : 0;
} else {
    $_SESSION[$turnCookieName] = rand(0, 1);
}

$isGetRequest = $_SERVER["REQUEST_METHOD"] == "GET";

if (
    $isGetRequest
    && isset($_GET["row"])
    && isset($_GET["column"])
    && isCoordinate($_GET["row"]
    && isCoordinate($_GET["column"]))
    ) {
    
}

if (isset($_SESSION[$connectFourCookieName])) {
    $players = json_decode($_SESSION[$connectFourCookieName]);

    $player1 = new Player(
        $players->player1->firstName,
        $players->player1->lastName,
        $players->player1->color,
        $players->player1->address,
        $players->player1->country,
        $players->player1->province,
        $players->player1->age,
    );

    $player2 = new Player(
        $players->player2->firstName,
        $players->player2->lastName,
        $players->player2->color,
        $players->player2->address,
        $players->player2->country,
        $players->player2->province,
        $players->player2->age,
    );
} else {
    echo "Fuck! Something went wrong!";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connect 4 &mdash; Game</title>
    <link rel="stylesheet" href="./style.css">
</head>
<body>
    <div class="connectfour__wrapper">
        <table>
            <tr>
                <th>&nbsp;</th>
                <th>Player 1</th>
                <th>Player 2</th>
            </tr>
            <tr>
                <td>First Name</td>
                <td><?php echo $player1->getFirstName(); ?></td>
                <td><?php echo $player2->getFirstName(); ?></td>
            </tr>
            <tr>
                <td>Last Name</td>
                <td><?php echo $player1->getLastName(); ?></td>
                <td><?php echo $player2->getLastName(); ?></td>
            </tr>
            <tr>
                <td>Address</td>
                <td><?php echo $player1->getAddress(); ?></td>
                <td><?php echo $player2->getAddress(); ?></td>
            </tr>
            <tr>
                <td>Country</td>
                <td><?php echo $player1->getCountry(); ?></td>
                <td><?php echo $player2->getCountry(); ?></td>
            </tr>
            <tr>
                <td>Province</td>
                <td><?php echo $player1->getProvince(); ?></td>
                <td><?php echo $player2->getProvince(); ?></td>
            </tr>
            <tr>
                <td>Age</td>
                <td><?php echo $player1->getAge(); ?></td>
                <td><?php echo $player2->getAge(); ?></td>
            </tr>
            <tr>
                <td>Color</td>
                <td><?php echo $player1->getColor(); ?></td>
                <td><?php echo $player2->getColor(); ?></td>
            </tr>
        </table>
    </div>
</body>
</html>