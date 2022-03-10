<?php
    require 'configDB.php';
    $data = json_decode(file_get_contents("php://input"));

    $id = filter_var(trim($data->id), FILTER_SANITIZE_STRING);


    $sql = "DELETE FROM `usersinfo` WHERE `id` = $id";

    if(mysqli_query($con,$sql)){
        echo 1; 
     }else{
        echo 0;
     }
   
     exit;

?>