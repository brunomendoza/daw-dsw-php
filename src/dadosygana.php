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
            include_once("./functions.php");
            
            function are_even($values) {
                $are_even = true;
                $values_length = count($values);
                $i = 0;
            
                if ($values_length > 0) {
                    while ($i < $values_length && $are_even) {
                        if ($values[$i] % 2 != 0) {
                            $are_even = false;
                        }
            
                        $i++;
                    }
                }
            
                return $are_even;
            }
            
            function at_least_two_six($values) {
                $count = 0;
            
                for ($i=0; $i < count($values); $i++) { 
                    if ($values[$i] == 6) {
                        $count++;
                    }
                }
            
                return $count > 1;
            }

            function get_candy_name() {
                $number = rand(1, 3);

                switch ($number) {
                    case 1:
                        return "piruletaverde-60w.png";
                    
                    case 2:
                        return "piruletaroja-60w.png";

                    case 3:
                        return "piruletaamarilla-60w.png";
                    
                    default:
                        break;
                }
            }
            
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
            $greatest_value;

            $isDebugging = false;

            for ($i=0; $i < $diceQuantity; $i++) { 
                $result = rand(1, $facesPerDice);;
                $values[$i] = $result;
                $sum += $result;
            }

            $greatest_value = greatest_match($values);

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
                } else if ($greatest_value > -1) {
                    ?>
                    <div class="prize-title">
                        <h3>Third Prize</h3>
                    </div>
                    <div class="prize-graphic">
                    <?php
                    for ($i=0; $i < $greatest_value; $i++) { 
                        ?>
                    <img src="<?php echo("./assets/".get_candy_name()); ?>" alt="">
                    <?php
                    }
                    ?>
                    </div>
                    <?php
                    if (are_even($values) || at_least_two_six($values)) {
                    ?>
                    <div class="play-button-wrapper">
                        <button id="start-button">Play Again!</button>
                    </div>
                    <?php
                    }
                } else if (are_even($values) || at_least_two_six($values)){
                    ?>
                    <div class="play-button-wrapper">
                        <button id="start-button">Play Again!</button>
                    </div>
                    <?php
                } else {
                    ?>
                    <p>Bad luck! :-(</p>
                    <?php
                }
                ?>
            </div>
        </div>
    </div>
    <script src="./script.js"></script>
</body>
</html>