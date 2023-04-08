<?php

session_start();
if (!isset($_SESSION["admin_name"])) {
    header("location: LoginPage.php");
} else
if ($_SESSION["admin_name"] != "1")
    header("location:homePage.php");
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$dbname = 'carrentalsystem';
$type = "";
$mysqli = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
if ($mysqli->connect_error) {
  die("Connectection failed " . $mysqli->connect_error);
}
if (isset($_POST['submit'])) {
  $VIN = $_POST['VIN'];
  $type = $_POST['Type'];
  $color = $_POST['Color'];
  $model = $_POST['Model'];
  $year = $_POST['Year'];
  $seats = $_POST['seats'];
  $branch = $_POST['branch'];
  $price = $_POST['price'];
  $status = $_POST['status'];
  $sql2 = "INSERT INTO car (VIN, type ,color,model,year,seating_capacity,branch_id,price_day,car_status) VALUES ('$VIN','$type','$color','$model','$year','$seats','$branch','$price','$status')";
  $result2 = $mysqli->query($sql2);
  if ($result2 == TRUE) {
    echo '<script> alert("car added");window.location.replace("AddCars.php");</script>';
    return True;
  } else {
    echo '<script> alert("VIN ALREADY EXISTS"); window.location.replace("AddCars.php") </script>';
  }
}


$mysqli->close();

?>
<HTML>

<head>
  <link rel="stylesheet" href="cars.css">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <title>Add cars</title>
  <script>
    function navigateHome() {
      window.location.replace('home.php');
    }

    function logOut() {
      if (confirm("Are you sure you want to logout?"))
        window.location.replace('logout.php');
    }

    function navigateCars() {
      window.location.replace('filteradmin.php');
    }

    function navigateAdd() {
      window.location.replace('AddCars.php');
    }

    function navigateRes() {
      window.location.replace('indextest2.php')
    }

    function navigateDaily() {
      window.location.replace('DailyReports.php');
    }
  </script>
</head>

<body>
  <div class="top">
    <a href="#home" class="btn" onClick="navigateHome()">Home</a>
    <a href="#cars" class="btn" onClick="navigateCars()">View system cars</a>
    <a href="#reservations" class="btn" onClick="navigateRes()">View Reservations</a>
    <a href="#add" class="btn" onClick="navigateAdd()">Add new car</a>
    <a href="#DailyReports" class="btn" onClick="navigateDaily()">View daily reports</a>
    <a href="#logOut" class="btn out" onClick="logOut()">Logout</a>
  </div>
  <div class="container">
    <h3 class="title t">Car Specs</h3>
    <form method="POST" class="t1">
      <Label style="margin-right:250px">VIN :</label><input type="text" name="VIN" placeholder="Enter Full Name" Required>
      <br /><br>
      <Label style="margin-right:240px">Color : </label><input type="text" name="Color" placeholder="Enter Color" Required>
      <br /><br>
      <Label style="margin-right:250px">Type : </label><input type="text" name="Type" placeholder="Enter TYPE" Required>
      <br /><br>
      <Label style="margin-right:240px">Model : </label> <input type="text" name="Model" placeholder="Enter Model" Required>
      <br /><br>
      <Label style="margin-right:255px">Year: </label><input type="text" name="Year" placeholder="Enter Year" Required>
      <br /><br>
      <Label style="margin-right:240px">Seats : </label><input type="text" name="seats" placeholder="Enter no of seats" Required>
      <br /><br>
      <Label style="margin-right:240px">Branch : </label><input type="text" name="branch" placeholder="Enter Branch_id" Required>
      <br /><br>
      <Label style="margin-right:250px">Price : </label><input type="text" name="price" placeholder="Enter price" Required>
      <br /><br>
      <Label style="margin-right:245px">status : </label><input type="text" name="status" placeholder="Enter status" Required>
      <br /><br>
      <input type="submit" class="sub" name="submit" value="Submit">
    </form>
  </div>
</body>

</html>