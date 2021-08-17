<?php

function arrayFlatten($arr)
{
    if (!is_array($arr))
        return $arr;
    $output = array();
    $index = 0;
    foreach ($arr as $sub_array) {
        if (!is_array($sub_array)) {
            $output[$index] = $sub_array;
            $index++;
        } else {
            $numbers = arrayFlatten($sub_array);
            foreach ($numbers as $number) {
                $output[$index] = $number;
                $index++;
            }
        }
    }
    return $output;
}

$input = [2, 3, [4, 5], [6, 7], [8, [9, 10]], 11];
print_r(arrayFlatten($input));
print_r(arrayFlatten(1));
//print_r($input);