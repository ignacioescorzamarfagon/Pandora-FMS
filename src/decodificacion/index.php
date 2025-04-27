<?php

//Manipulated file (user_name, number_system,coded_score)
$lines = [
    "Patata,oi8,oo",
    "ElMejor,oF8,Fo",
    "BoLiTa,0123456789,23",
    "Azul,01,01100",
    "OtRo,54?t,?4?",
    "Manolita,kju2aq,u2ka",
    "PiMiEnTo,_-/.!#,#_"
];


//Iterate each line of the file
foreach ($lines as $line){
    //Split the line into user, digit set and encoded score
    list($user, $system, $code) = explode(',',$line);

    try {
        //Try to decode the score
        $score = decode_score($code, $system);

        //Output the result
        echo $user . " has a score of " . $score . "<br>";
    }catch (Exception $e) {
        // If an error occurs, display it.
        echo "$user: Error decoding - " . $e->getMessage() . "<br>";
    }
}


 /**
 * Function to decode a score from a custom number system to base 10
 * 
 * @param string    $encoded The encoded score (example: "u2ka)
 * @param string    $digits The set of symbols that define the number system (example: "kju2aq")
 * @return int      Scoring in base 10
 */

 function decode_score($encoded, $digits){
    $base = strlen($digits); //Determine the base according to the length of the digit set
    $value = 0; //Initilize the variable that will return the expected value
    
    //Loop through each character in the encoded score
    for ($i = 0; $i < strlen($encoded); $i++){
        $char = $encoded[$i];

        //Find the system caracter position. This position is the value in the base.
        $pos = strpos($digits, $char);

        //If the character is not found, thow an error.
        if($pos === false){
            throw new Exception("Character '$char' is not found in the system '$digits'");
        }

        //Apply base conversion: value = value * base + digit_value
        $value = $value * $base + $pos;
    }
    
    return $value; //Return the final score

 }



?>
