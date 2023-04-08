<?php

    $host = "localhost";
    $dbUsername = "root";
    $dbPassword = "";
    $dbName = "carrentalsystem";
    $conn = new mysqli($host, $dbUsername, $dbPassword, $dbName);
    if ($conn->connect_error) {
        die ("Could not connect to the database". mysqli_connect_error());
    }
   
    

?>