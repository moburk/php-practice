<?php

function maskPhoneNumber($phone_number)
{
    if (strlen($phone_number) != 10) {
        return "Phone number has invalid length!";
    }
    $masked_number = substr($phone_number, 0, 2);
    for ($i = 0; $i < 6; $i++) {
        $masked_number = $masked_number . "*";
    }
    $masked_number = $masked_number . substr($phone_number, 8);
    return $masked_number;
}

$test_input = "9876543210";
print("Masking $test_input = " . maskPhoneNumber($test_input) . "\n");

$user_input = readline("Enter a phone number: ");
print("Masking user input = " . maskPhoneNumber($user_input) . "\n");


