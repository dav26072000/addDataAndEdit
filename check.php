<?php
 require 'configDB.php';

 $firstName = filter_var(trim($_POST['firstName']), FILTER_SANITIZE_STRING);
 $lastName = filter_var(trim($_POST['lastName']), FILTER_SANITIZE_STRING);
 $date = filter_var(trim($_POST['date']) , FILTER_SANITIZE_STRING);
 $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_STRING);
 $phoneNumber = filter_var(trim(str_replace("+", '', $_POST['phoneNumber'])), FILTER_SANITIZE_STRING);

//  echo $firstName;
//  echo $lastName;
//  echo $date;
//  echo $email;
//  echo $phoneNumber;

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
 

 $mysql->query("INSERT INTO `usersinfo` (`firstName`, `lastName`, `date`, `email`, `phoneNumber`) 
 VALUES ('$firstName', '$lastName', '$date', '$email', '$phoneNumber')");

 $mysql->close();

 header("Location:/");

?>