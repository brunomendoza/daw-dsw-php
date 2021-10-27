<?php
include_once("./acme/functions.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo("DAW &mdash; DSL"); ?></title>
</head>
<body>
    <div class="wrapper">
        <ul>
            <li>
                <div>
                    <h2>Dices</h2>
                    <ul>
                        <li>
                            <a href="./dices/dadosygana.php">Dice Game</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li>
                <div>
                    <h2>Running</h2>
                    <ul>
                        <?php
                        $cookieName = "acme_game";
                        if (cookieExists($cookieName)):
                            ?>
                        <li>
                            <a href="./acme/resume_game.php">Resume ACME game</a>
                        </li>
                        <?php
                        endif
                        ?>
                        <li>
                            <a href="./acme/restart_game.php">Start ACME game</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li>
                <div>
                    <h2>Connect Four</h2>
                    <ul>
                        <li>
                            <a href="./connectfour/connect_four.php">Connect Four</a>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
    </div>
</body>
</html>