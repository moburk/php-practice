<?php

$d = date("D");
if ($d == "Fri") {
    print("have a good weekend");
} else if ($d == "Tue")
    print($d . " today");
else
    print("today is not friday. today is " . $d);

$var = 5;
print("$var");
$var = "foo";
print($var);
$var = TRUE;
print($var);
