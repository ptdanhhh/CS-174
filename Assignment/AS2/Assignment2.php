
<?php
// Danh Pham
// Assignment #2 - Classes

class primeNumber {
    public function primesInRange($a, $b) { //function that find and print prime number
        if ($a < 2) {
            $a = 2;
        }

        $primeNumbers = array();

        for ($i = $a; $i <= $b; $i++) {
            if ($this->isPrime($i)) {
                $primeNumbers[] = $i;
            }
        }

        echo implode(', ', $primeNumbers);
        echo "</br>";
        echo "</br>";
    }

    private function isPrime($number) { // function that check prime number
        if ($number <= 1) {
            return false;
        }

        if ($number <= 3) {
            return true;
        }

        if ($number % 2 == 0 || $number % 3 == 0) {
            return false;
        }

        $i = 5;
        while ($i * $i <= $number) {
            if ($number % $i == 0 || $number % ($i + 2) == 0) {
                return false;
            }
            $i += 6;
        }

        return true;
    }
   
    public function testPrimesInRange($primeNumbers) { // test function

        // Test case 1: Check if the output for (5, 10) is "5, 7"
        $expectedNumber1 = [5, 7];
        if ($expectedNumber1 === $primeNumbers) {
            echo "Test 1 passed !";
        } else {
            echo "Test 1 failed !!!";
        }
        
        echo "</br>";
        echo "</br>";

        // Test case 2: Check if the output for (5, 10) is "5, 7"
        $expectedNumber2 = [1, 4];
        if ($expectedNumber2 === $primeNumbers) {
            echo "Test 2 passed !";
        } else {
            echo "Test 2 failed !!!";
        }

        
    }
}

// Example usage:
$test = new primeNumber(); 

$test->testPrimesInRange($test->primesInRange(5,10));
?>