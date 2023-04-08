<?php
    $servername = "127.0.0.1";
    $username = "root";
    $password = "";
    $dbname = "CarRentalSystem";
    $conn = mysqli_connect($servername, $username, $password, $dbname);
        
   
    if($conn === false){
        die("ERROR: Could not connect. " 
            . mysqli_connect_error());
    }
    
    $card_no =  $_POST['card_no'] ;
    $exp_date = $_POST['exp_date'];
    $cvv =  $_POST['cvv'] ;
    $name_on_card = $_POST['name_on_card'] ;
    
    session_start();
    $SSN = $_SESSION['SSN'];
    $VIN = $_SESSION['VIN'];
        
    $sql = "INSERT INTO Card (SSN, card_number, expiry_date, CVV, name_on_card) VALUES ('$SSN', '$card_no', 
         '$exp_date','$cvv','$name_on_card')";

    

    if(mysqli_query($conn, $sql)){
        header('location: payment1.php');
        
    } else{
        echo "ERROR: Hush! Sorry $sql. " 
            . mysqli_error($conn);
    }

    // Close connection
    mysqli_close($conn);
?>




