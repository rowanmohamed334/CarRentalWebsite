<?php

$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$dbname = 'carrentalsystem';
$mysqli = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
            if($mysqli->connect_error ) {
             die("Connectection failed ". $mysqli->connect_error) ;
             
            }

?>