<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo("Dados y Gana") ?></title>
    <link rel="stylesheet" href="./style.css">
</head>
<body>
    <div class="wrapper">
        <div class="dice-wrapper">
            <?php
            date_default_timezone_set('Atlantic/Canary');

            $facesPerDice = 6;
            $diceQuantity = 6;
            $values = array();
            $sum = 0;
            $result;
            $currentHour = (int)date('G');
            $currentDay = (int)date('d');

            $multiplier = (24 - $currentHour);
            $price = $multiplier * 100;

            $secondPrize = rand(1, 4);

            $isDebugging = true;

            for ($i=0; $i < $diceQuantity; $i++) { 
                $result = rand(1, $facesPerDice);;
                $values[$i] = $result;
                $sum += $result;
            }

            if ($isDebugging) {
                $sum = $facesPerDice * $diceQuantity;
                // $sum = $currentDay;
            }

            foreach ($values as $key => $value) {
            ?>
            <div class="dice">
                <img src="<?php echo("./assets/dado".$value."-96w.png")?>" alt="">
            </div>
            <?php
            }
            ?>
        </div>
        <div class="play-button-wrapper">
            <button id="start-button">Play Again!</button>
        </div>
        <div class="prize-wrapper">
            <h2>Prize</h2>
            <div class="inner-prize-wrapper">
                <?php
                if ($sum == $facesPerDice * $diceQuantity) {
                    ?>
                    <div class="prize-title">
                        <h3>First Prize</h3>
                        <p>You have won <?php echo($price); ?>€</p>
                    </div>
                    <div class="prize-graphic">
                    <?php
                    for ($i=0; $i < $multiplier; $i++) { 
                    ?>
                    <img class="prize-note" src="./assets/moneda-60w.png" alt="">
                    <?php
                    }
                    ?>
                    </div>
                    <?php
                } else if ($sum == $currentDay) {
                    ?>
                    <div class="prize-title">
                        <h3>Second Prize</h3>
                    </div>
                    <div class="prize-graphic">
                        <?php
                    switch ($secondPrize) {
                        case 1:
                        ?>
                        <img class="" src="./assets/balon_basketball-120w.png" alt="">
                        <?php
                            break;
                        case 2:
                        ?>
                        <img class="" src="./assets/balon_futbol-120w.png" alt="">
                        <?php
                            break;
                        case 3:
                        ?>
                        <img class="" src="./assets/peluche-120w.png" alt="">
                        <?php
                            break;
                        
                        case 4:
                        ?>
                        <img class="" src="./assets/tickets-120w.png" alt="">
                        <?php
                            break;

                        default:
                            break;
                    }
                    ?>
                    </div>
                    <?php
                } else if (true) {
                    
                }
                ?>
            </div>
        </div>
    </div>
    <script src="./script.js"></script>
</body>
</html>