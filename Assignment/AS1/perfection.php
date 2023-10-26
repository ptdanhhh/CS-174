
<?php
// Danh Pham
// Assignment #1 - Perfection 

function isPerfectNumber($number) {

    $divisors = array();
    $sum = 0;

    for ($i = 1; $i < $number; $i++) {
        if ($number % $i == 0) {
            $divisors[] = $i;
            $sum += $i;
        }
    }

    if ($sum == $number) {
        return "Yes, this is a perfect number. Proof: " . implode('+', $divisors) . " = " . $number;
    } else {
        return "No, this is not a perfect number. Proof: " . implode('+', $divisors) . " != " . $number;
    }
}

//test function
function tester_function($number) {

    $sum = 0;
    for ($i = 1; $i < $number; $i++) {
        if ($number % $i == 0) {
            $sum += $i;
        }
    }
    if ($sum == $number) {
        echo "Test passed, $number is a perfect number.";
    } else {
        echo "Test failed, $number is not a perfect number.";
    }
}


// Example usage:
$number = 12; // Change this to the number you want to test
$result = isPerfectNumber($number);
echo $result;
echo "</br>";
echo "</br>";
tester_function($number); // use test function

?>