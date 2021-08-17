<?php

class Car
{
    public function __construct($make, $year)
    {
        $this->make = $make;
        $this->year = $year;
    }

    public function print_details()
    {
        print("This car is a $this->year $this->make.");
    }
}

$car = new Car("Toyota", 2006);
$car->print_details();