<?php

require_once("connectfour/model/Player.php");
require_once("connectfour/model/Game.php");

use connectfour\model\Game;
use connectfour\model\Player;

$game = new Game(8);


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
    <div class="wrapper">
        <h1>Connect 4</h1>
        <?php if (!$game->isGameOver()): ?>
            <?php $game->drawHud(); ?>
            <div class="board">
                <?php $game->drawBoard(); ?>
            </div>
            <?php $game->drawPlayerInformation(); ?>
        <?php else: ?>
            <a class="connectfour_new_game" href="./connect_four.php">Play Again</a>
        <?php endif; ?>
    </div>
</body>
</html>