<?php

function snakeCaseToCamelCase($input_word_array)
{
    if (!is_array($input_word_array))
        return $input_word_array;

    $output_word_array = array();

    foreach ($input_word_array as $input_word) {
        $word_list = explode("_", $input_word);

        $camel_case_word = strtolower($word_list[0]);
        for ($i = 1; $i < count($word_list); $i++) {
            $camel_case_word .= ucfirst($word_list[$i]);
        }

        array_push($output_word_array, $camel_case_word);
    }

    return $output_word_array;
}

$input_word_array = ["snake_case", "camel_case", "Hello_world_bye"];
print_r(snakeCaseToCamelCase($input_word_array));
