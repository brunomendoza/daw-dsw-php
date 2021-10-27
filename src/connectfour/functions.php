<?php

function isCoordinate($number) {
    $filter_options = array(
        "options" => array(
            "min_range" => 1,
            "max_range" => 8,
        ),
    );

    return filter_var($number, FILTER_VALIDATE_INT, $filter_options);
}