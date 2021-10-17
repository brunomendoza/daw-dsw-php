<?php
include_once("./functions.php");
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
                            <a href="./dadosygana.php">Dice Game</a>
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
                            <a href="./resume_game.php">Resume ACME game</a>
                        </li>
                        <?php
                        endif
                        ?>
                        <li>
                            <a href="./restart_game.php">Start ACME game</a>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
    </div>
</body>
</html>