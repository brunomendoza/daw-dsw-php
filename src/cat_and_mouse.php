<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php print("cat and mouse"); ?></title>
    <link rel="stylesheet" href="./style.css">
</head>
<body>
    <div id="root">
        <?php
        include_once("./Location.php");

        $columns = 5;
        $rows = 5;
        $values;
        $board = array();
        
        function generateRandomLocation($columnLength, $rowLength) {
            $x = rand(0, $columnLength -1);
            $y = rand(0, $rowLength - 1); 
            return new Location(3, 2);
        }

        $locaction = generateRandomLocation($columns, $rows);
        
        ?>
            <div class="board">
                <?php
            for ($i=0; $i < $columns; $i++) {
                for ($j=0; $j < $rows; $j++) { 
                    ?>
                    <div class="board__cell <?php echo($j % 2 == 0 ? "board__cell--even" : "board__cell--odd"); ?>"><?php printf("column: %d, row: %d", $i, $j); ?></div>
                    <?php
                }
            }
            ?>
            </div> 
    </div>
</body>
</html>