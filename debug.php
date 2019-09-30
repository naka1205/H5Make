<?php

//FI9sHYuEiENCErljSb0C2fB13UWLrVAjOJtN8FYJc1amQlSyAH15s+11cLjmhfne/sehcDWXqVoKfjAJCQaO2Q==
//ZTkyZjEzMjM2OWU4MmMxZDU3MzQ3N2M3MTcxMzM4MzE1NWRlM2YzYmNhMmIzY2JhMWYzNzQ0ZTkyMDNjYjM3Mg==
// var_dump(base64_encode(openssl_random_pseudo_bytes(16)));


// $salt = base64_encode(openssl_random_pseudo_bytes(16));
// $saltdd = base64_decode($salt);
// var_dump($saltdd);
// die;

//e92f132369e82c1d573477c71713383155de3f3bca2b3cba1f3744e9203cb37292dff092f36ffc5b42dc28efc8cd053b68ad7f1532daed1d47adc7ec86a3cf69
//e92f132369e82c1d573477c71713383155de3f3bca2b3cba1f3744e9203cb37292dff092f36ffc5b42dc28efc8cd053b68ad7f1532daed1d47adc7ec86a3cf69

//148f6c1d8b8488434212b96349bd02d9f075dd458bad5023389b4df056097356a64254b2007d79b3ed7570b8e685f9defec7a1703597a95a0a7e300909068ed9
//148f6c1d8b8488434212b96349bd02d9f075dd458bad5023389b4df056097356a64254b2007d79b3ed7570b8e685f9defec7a1703597a95a0a7e300909068ed9

// $str1 = base64_decode('e92f132369e82c1d573477c71713383155de3f3bca2b3cba1f3744e9203cb37292dff092f36ffc5b42dc28efc8cd053b68ad7f1532daed1d47adc7ec86a3cf69');

//148f6c1d8b8488434212b96349bd02d9f075dd458bad5023389b4df056097356a64254b2007d79b3ed7570b8e685f9defec7a1703597a95a0a7e300909068ed9
//148f6c1d8b8488434212b96349bd02d9f075dd458bad5023389b4df056097356a64254b2007d79b3ed7570b8e685f9defec7a1703597a95a0a7e300909068ed9

// $str = '148f6c1d8b8488434212b96349bd02d9f075dd458bad5023389b4df056097356';
// var_dump(base64_encode($str));
// die;

// $str1 = 'FI9sHYuEiENCErljSb0C2fB13UWLrVAjOJtN8FYJc1amQlSyAH15s+11cLjmhfne/sehcDWXqVoKfjAJCQaO2Q==';
// // $str1 = str_replace("+","%2B",$str1);
// // $str1 = str_replace("/","%2F",$str1);
// // $str1 = urlencode($str1);
// // $str2 = urldecode($str1);
// $str2 = base64_decode($str1);
// $str3 = String2Hex($str2);
// var_dump($str1);
// var_dump($str2);
// var_dump($str3);
// die;

function String2Hex($string){
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

function Hex2String($hex){
    $string='';
    for ($i=0; $i < strlen($hex)-1; $i+=2){
        $string .= chr(hexdec($hex[$i].$hex[$i+1]));
    }
    return $string;
}

function toByte($string){
    $b = [];
    for ($i=0; $i < strlen($string); $i++) { 
        $b[] = ord($string[$i]);
    }
    return $b;
}

// $defaultIterations = 10000;
// $defaultKeyLength = 64;
// $salt = 'GbqnBQM0uFVwA1hYdnOfNw==';
// $salt = base64_decode($salt);

// $ppp = hash_pbkdf2("sha1", '123456', $salt, $defaultIterations, $defaultKeyLength);
// $bbb = base64_encode($ppp);
// var_dump($ppp);
// var_dump($bbb);
// die;

require __DIR__ . '/vendor/autoload.php';

define('DS', DIRECTORY_SEPARATOR);


require __DIR__ . DS . "db.php";

use Models\User;
use think\Db;

$user = User::get(['loginId'=> 'naka']);
var_dump($user->_id);
die;


// $user = new User();
// $user->where('loginId', 'naka')->find();

$data = User::all();
var_dump($data);
die;


$data = Db::table('users')->where(['loginId'=> 'naka'])->find();
// $data = User::where(['loginId'=> 'admin'])->find();
var_dump($data);