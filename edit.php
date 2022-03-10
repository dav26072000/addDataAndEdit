<?php

require 'configDB.php';
$data = json_decode(file_get_contents("php://input"));

$id = filter_var(trim($data->id), FILTER_SANITIZE_STRING);

$firstName = filter_var(trim($data->firstName), FILTER_SANITIZE_STRING);
$lastName = filter_var(trim($data->lastName), FILTER_SANITIZE_STRING);
$date = filter_var(trim($data->date), FILTER_SANITIZE_STRING);
$email = filter_var(trim($data->email), FILTER_SANITIZE_STRING);
$phoneNumber = filter_var(trim($data->phoneNumber), FILTER_SANITIZE_STRING);

// validation
if (strlen($firstName) === 0 || strlen($lastName) === 0 || strlen($date) === 0 ) {
    exit();
}

$emailPattern = "/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/";
if(!preg_match($emailPattern, $email)){
    exit();
}

$phoneNumberPattern = "/^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{3,6}$/im";
if(!preg_match($phoneNumberPattern, $phoneNumber)){
    exit();
} 
// 

$sql = "UPDATE `usersinfo` SET `firstName`='$firstName',`lastName`='$lastName',`date`='$date',`email`='$email',`phoneNumber`='$phoneNumber'WHERE `id` = $id";

if(mysqli_query($con,$sql)){
    echo 1; 
    }else{
    echo 0;
    }

    exit;

?>