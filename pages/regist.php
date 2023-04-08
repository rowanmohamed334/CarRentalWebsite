<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "carrentalsystem";
$fName=$_POST['fName'];
$lName=$_POST['lName'];
$ssn=$_POST['ssn'];
$email=$_POST['email'];
$signUpUsername=$_POST['signUpUsername'];
$pass=$_POST['pass1'];
$dob=$_POST['dob'];
$phone=$_POST['phone'];
$pass=md5($pass);
session_start();
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
$sql1 = "SELECT username FROM user WHERE username='$signUpUsername' or SSN='$ssn'";
$result = $conn->query($sql1);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
      $_SESSION['error']=1;
      header("location= LoginPage.php");
    } }
else {
    $sql = "insert into user (`SSN`, `username`, `Fname`, `Lname`, `email`, `password`, `DOB`, `phone`) 
    values ('$ssn','$signUpUsername','$fName','$lName','$email','$pass','$dob','$phone')";
    $sql2="select userid from user where SSN='$ssn'";
    if ($conn->query($sql) === TRUE) {
      $x=$conn->query($sql2);
      while($row = $x->fetch_assoc()) {
        $_SESSION['admin_name']=$row['userid'];
        $_SESSION['error']=2;
        if($row['userid']="1")
          header("location: try.php");
        header("location: home.php");
      } 
    }
      else {
        echo "Error: " . $sql . "<br>" . $conn->error;
      }
      

}
$conn->close();
?>
