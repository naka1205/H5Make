<?php

function stringToHex($string){
    $hex='';
    for ($i=0; $i < strlen($string); $i++){
        $value = dechex(ord($string[$i]));
        if( strlen($value) == 1 ){
            $value = '0' . $value;
        }
        $hex .= $value;
    }
    return $hex;
}


function HexToString($hex){
    $string='';
    for ($i=0; $i < strlen($hex)-1; $i+=2){
        $string .= chr(hexdec($hex[$i].$hex[$i+1]));
    }
    return $string;
}


function stringToByte($string){
    $b = [];
    for ($i=0; $i < strlen($string); $i++) { 
        $b[] = ord($string[$i]);
    }
    return $b;
}