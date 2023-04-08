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
    
    // $payment_id =  $_POST['payment_id'] ;
    $total_price = $_POST['total_price'];
    $payment_time =  $_POST['payment_time'] ;
    $time_input = strtotime($payment_time); 
    $date_input = date('Y-m-d', $time_input);
    $payment_type = $_POST['payment_type'] ;
    session_start();
    $SSN = $_SESSION['SSN'];
    $VIN = $_SESSION['VIN'];
        
    $sql = "INSERT INTO Payment ( amount_paid, payment_time, payment_type, SSN, VIN) VALUES ( '$total_price', 
         '$date_input','$payment_type','$SSN', '$VIN')";
    

    if(mysqli_query($conn, $sql)){
        // header('location: payment1.php');
        echo '<script> alert("Done!!"); window.location.replace("homePage.php") </script>';
        
    } else{
        echo "ERROR: Hush! Sorry $sql. " 
            . mysqli_error($conn);
    }

    // Close connection
    mysqli_close($conn);
?>




