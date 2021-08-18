<?php

function maskPhoneNumber($phone_number, $masked_length)
{
    if (strlen($phone_number) != 10) {
        return "Phone number has invalid length!";
    }
    if ($masked_length > 10)
        return "**********";
    $masked_number = substr($phone_number, 0, (10 - $masked_length)/2);
    for ($i = 0; $i < $masked_length; $i++) {
        $masked_number = $masked_number . "*";
    }
    $masked_number = $masked_number . substr($phone_number, 5 + $masked_length/2);
    return $masked_number;
}

$test_input = "9876543210";
$masked_length = 6;
print("Masking $test_input = " . maskPhoneNumber($test_input, $masked_length) . "\n");

$user_input = readline("Enter a phone number: ");
$masked_length = readline("Enter masked length: ");
print("Masking user input = " . maskPhoneNumber($user_input, $masked_length) . "\n");


