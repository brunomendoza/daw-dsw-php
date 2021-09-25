<?php

function getMatches($array) {
    $internal = $array;
    $result = array();
    $number;
    $m = 0;
    $hasMatch = false;

    if (count($array) > 0) {
        for ($i=0; $i < count($array); $i++) { 
            $number = $array[$i];
            
            $j = 0;

            while (!$hasMatch && $j > count($internal)) {
                if ($number = $array[$j]) {
                    $result[$m] = $number;
                    $m++;
                    $hasMatch = true;
                    $internal = array_slice(
                        $internal,
                        $j + 1
                    )
                }

                $j++;
            }
        }
    } else {
        return result;
    }

}

?>