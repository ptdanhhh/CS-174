<?php

// Function to calculate the sum of 5 adjacent numbers with the largest sum
function findLargestSum($numbers) {
    $maxSum = 0;
    $currentSum = 0;

    for ($i = 0; $i < strlen($numbers) - 4; $i++) {
        $currentSum = intval($numbers[$i]) +
                      intval($numbers[$i + 1]) +
                      intval($numbers[$i + 2]) +
                      intval($numbers[$i + 3]) +
                      intval($numbers[$i + 4]);

        if ($currentSum > $maxSum) {
            $maxSum = $currentSum;
            $maxNumbers = substr($numbers, $i, 5);
        }
    }

    return $maxNumbers;
}

// Function to calculate the sum of factorials of the digits in a number
function sumOfFactorial($number) {
    $sum = 0;
    for ($i = 0; $i < strlen($number); $i++) {
        $digit = intval($number[$i]);
        $factorial = 1;
        for ($j = 1; $j <= $digit; $j++) {
            $factorial *= $j;
        }
        $sum += $factorial;
    }
    return $sum;
}

// Check if a file was uploaded
if (isset($_FILES["fileToUpload"])) {
    $file = $_FILES["fileToUpload"];

    if ($file["error"] === UPLOAD_ERR_OK && $file["type"] === "text/plain") {
        $content = file_get_contents($file["tmp_name"]);

        // Remove any non-digit characters from the content
        $numbers = preg_replace("/[^0-9]/", "", $content);

        // Find the 5 adjacent numbers with the largest sum
        $largestSumNumbers = findLargestSum($numbers);

        // Calculate the sum of factorials of those numbers
        $sumFactorials = sumOfFactorial($largestSumNumbers);

        echo "The 5 adjacent numbers with the largest sum are: $largestSumNumbers<br>";
        echo "The sum of factorials of those numbers is: $sumFactorials";
    } else {
        echo "Please upload a valid .txt file.";
    }
} else {
    echo "Please upload a file";
}

?>


 
  

 