
 <?php
  
//   include("db.php");
//   $VIN = $_POST['VIN'];
//   $query = "SELECT price_day FROM CAR  WHERE vin ='$VIN'";
//   $result = mysqli_query($conn, $query);
  

//   if ($row = mysqli_fetch_array($result))
//   {
//       $cost = $row['price_day'];
//       echo"price_day : ".$cost;
//       echo"<br>";
 
//   }


 ?>
     

<?php
 session_start();
 if (isset($_POST['submit'])) {
         

         $SSN = $_SESSION['SSN'];
         echo"SSN : ".$SSN;
         echo"<br>";
         $VIN = $_POST['VIN'];
         $_SESSION['VIN'] = $VIN;
         echo"VIN : ".$_SESSION['VIN'];
         $pickup = $_POST['p'];
        //  $pickup_str = strtotime($pickup);
         $return = $_POST['r'];
        //  $return_str = strtotime($return);
         
       
        //  $diff = abs($return_str - $pickup_str);
        //  $years = floor($diff / (365*60*60*24));
 
       
        //  $months = floor(($diff - $years * 365*60*60*24)
        //                                 / (30*60*60*24));
        
        
        //  $days = floor(($diff - $years * 365*60*60*24 -
        //               $months*30*60*60*24)/ (60*60*24));
        // echo"days :".$days;
        // echo"<br>";
        // echo"months :".$months;
        // echo"<br>";
        //  $price = ($days+30*$months)*$cost;
        //  echo"Total price : ".$price;
        //  echo"<br>";
         $host = "localhost";
         $dbUsername = "root";
         $dbPassword = "";
         $dbName = "carrentalsystem";
         $conn = new mysqli($host, $dbUsername, $dbPassword, $dbName);
         if ($conn->connect_error) {
             die('Could not connect to the database.');
         }
         else {
            
            
             $sql = "INSERT INTO reservation (VIN,SSN,pickup_date , return_date)
             VALUES ('$VIN','$SSN' ,'$pickup' , '$return')";
             if (mysqli_query($conn, $sql)) {
                echo "New record created successfully !";
                echo"<br>";
                header('location:choose.php');
 
             } else {
                echo "Error: " . $sql . "" . mysqli_error($conn);}
            }
             $conn->close();
         }
     
 else {
     echo "Submit button is not set";
 }
 ?>
        
