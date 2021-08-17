<?php

function getDataFromJson($stringified_json) {
    $json = json_decode($stringified_json, true);
    $players = $json["players"];
    $names = array();
    $ages = array();
    $cities = array();
    $max_age = 0;
    $players_with_max_age = array();

    foreach ($players as $player) {
        array_push($names, $player["name"]);
        array_push($ages, $player["age"]);
        array_push($cities, $player["address"]["city"]);

        if($player["age"] > $max_age) {
            $players_with_max_age = array();
            array_push($players_with_max_age, $player["name"]);
            $max_age = $player["age"];
        } elseif ($player["age"] == $max_age) {
            array_push($players_with_max_age, $player["name"]);
        }
    }
    $unique_names = array_unique($names);

    $output = [
        "names" => $names,
        "ages" => $ages,
        "cities" => $cities,
        "unique_names" => $unique_names,
        "oldest_players" => $players_with_max_age,
    ];
    return $output;
}

$input_json = "{\"players\":[{\"name\":\"Ganguly\",\"age\":45,\"address\":{\"city\":\"Hyderabad\"}},{\"name\":\"Dravid\",\"age\":45,\"address\":{\"city\":\"Bangalore\"}},{\"name\":\"Dhoni\",\"age\":37,\"address\":{\"city\":\"Ranchi\"}},{\"name\":\"Virat\",\"age\":35,\"address\":{\"city\":\"Delhi\"}},{\"name\":\"Jadeja\",\"age\":35,\"address\":{\"city\":\"Hyderabad\"}},{\"name\":\"Jadeja\",\"age\":35,\"address\":{\"city\":\"Mumbai\"}}]}";

$output = getDataFromJson($input_json);
foreach ($output as $key => $value) {
    print($key . ": \n");
    print_r($value);
    print("\n");
}