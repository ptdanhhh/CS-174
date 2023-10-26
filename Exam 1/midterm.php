<?php

class numberConvert {

    public function RomanToInteger($roman) {
        $romanNumerals = [
            'I' => 1,
            'IV' => 4,
            'V' => 5,
            'IX' => 9,
            'X' => 10,
            'XL' => 40,
            'L' => 50,
            'XC' => 90,
            'C' => 100,
            'CD' => 400,
            'D' => 500,
            'CM' => 900,
            'M' => 1000
        ];

        $integerValue = 0;
        $roman = strtoupper($roman);

        while (!empty($roman)) {
            foreach ($romanNumerals as $numeral => $value) {
                if (strpos($roman, $numeral) === 0) {
                    $integerValue += $value;
                    $roman = substr($roman, strlen($numeral));
                }
            }
        }

        return $integerValue;
    }

    public function IntegerToRoman($integer) {
        $integerToRoman = [
            'M' => 1000,
            'CM' => 900,
            'D' => 500,
            'CD' => 400,
            'C' => 100,
            'XC' => 90,
            'L' => 50,
            'XL' => 40,
            'X' => 10,
            'IX' => 9,
            'V' => 5,
            'IV' => 4,
            'I' => 1
        ];

        $romanValue = '';

        foreach ($integerToRoman as $numeral => $value) {
            while ($integer >= $value) {
                $romanValue .= $numeral;
                $integer -= $value;
            }
        }
        return $romanValue;
    }
}

// Check if a file was uploaded
if (isset($_FILES["fileToUpload"])) {
    $file = $_FILES["fileToUpload"];

    if ($file["error"] === UPLOAD_ERR_OK && $file["type"] === "text/plain") {
        $content = file_get_contents($file["tmp_name"]);

        $converter = new numberConvert(); 

        $numArray = explode(" ", $content);   // example numArray value [1, 2, 3, 4, 5, I, II, III, IV, V, VI] 

        $numArrayLength = count($numArray); //9

        $tempArray = []; // init empty array


        for ($i = 0; $i < $numArrayLength; $i++) {

            if (is_numeric($numArray[$i])) {
                // Convert integer to Roman and assign value to empty arr
                $tempArray[$i] = $converter->IntegerToRoman($numArray[$i]);
            } else {
                // Convert Roman to integer and assign value to empty arr
                $tempArray[$i] = $converter->RomanToInteger($numArray[$i]);
            }
        }

        $finalString = implode(" ", $tempArray); // converted array value back to string
        echo $finalString; // print final value 
       
    } else {
        echo "Please upload a valid .txt file.";
    }
} else {
    echo "Please upload a file";
}

function testConverter() {
    $converter = new numberConvert();

    echo "<br>Conversion:<br>";

    // Test Roman to Integer conversion
    $romanNumerals = ["I", "II", "III", "IV", "V", "VI"];
    foreach ($romanNumerals as $romanNumeral) {
        $integerValue = $converter->RomanToInteger($romanNumeral);
        echo "Roman to Integer: $romanNumeral => $integerValue <br>";
    }

    // Test Integer to Roman conversion
    $integers = [1, 2, 3, 4, 5, 6];
    foreach ($integers as $integerValue) {
        $romanNumeral = $converter->IntegerToRoman($integerValue);
        echo "Integer to Roman: $integerValue => $romanNumeral <br>";
    }
}

testConverter();


?>
