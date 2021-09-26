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

?>