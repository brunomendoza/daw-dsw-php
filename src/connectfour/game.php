<?php

require_once("connectfour/model/Player.php");
use connectfour\model\Player;

$connectFourCookieName = "connect_four";

$players;
$player1;
$player2;

session_start();

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
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connect 4 &mdash; Game</title>
</head>
<body>
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
</body>
</html>