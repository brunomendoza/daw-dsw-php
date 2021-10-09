<?php
function greatest_match($values) {
    $greatest = -1;
    $current_value;
    $values_length = count($values);

    if ($values_length > 1) {
        for ($i=0; $i < $values_length; $i++) {
            $current_value = $values[$i];

            if ($values_length > $i + 1) {
                for ($j=$i + 1; $j < $values_length; $j++) { 
                    if ($values[$j] == $current_value && $current_value > $greatest) {
                        $greatest = $current_value;
                    }
                }
            } 
        }
    }

    return $greatest;
}

 /**
  * Coyote and Roadrunner
  */

function randomPosition($laterLocations) {
    
}
?>