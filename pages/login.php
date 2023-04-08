<?php
session_start();
if(isset($_SESSION["admin_name"])){
if($_SESSION["admin_name"]=="1"){
  header("location:home.php");
  echo"in if";
}
header("location: homePage.php");
}
// Create connection
$conn = new mysqli("localhost","root" , "" , "carrentalsystem");
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

if(isset($_POST["submit"])){
  $_SESSION["status"]=false;
  $lgInUsername=$_POST['lgInUsername'];
  $pass=$_POST['lgInPass'];
  $pass=md5($pass);
  $sql = "SELECT userid,SSN FROM user WHERE username='$lgInUsername' AND password='$pass'";
  $result = $conn->query($sql);
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
      $id=$row['userid'];
      $_SESSION["admin_name"] = $id;
      $_SESSION['SSN']=$row['SSN'];
      if($id=='1')
        header("Location: home.php" );
      else
      header("Location: homePage.php" );
    } 
}
else {
     echo "<SCRIPT> //not showing me this
       alert('Invalid Username or password')
       window.location.replace('LoginPage.php');
   </SCRIPT>";
  echo "ERROR";
}}
$conn->close();
