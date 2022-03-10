<?php
    $mysql = new mysqli('localhost','root','root','users');

    $con = mysqli_connect('localhost', 'root', 'root','users');
    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }

?>

