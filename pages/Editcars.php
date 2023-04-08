<?php
session_start();
if (!isset($_SESSION["admin_name"])) {
    header("location: LoginPage.php");
} else
if ($_SESSION["admin_name"] != "1")
    header("location:homePage.php");
?>

<html>

<head>
  <title>Display Selected HTML Table TR Values In Input Text</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="cars.css">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <style>
    table tr:not(:first-child) {
      cursor: pointer;
      transition: all .25s ease-in-out;
    }

    table tr:not(:first-child):hover {
      background-color: #ddd;
    }
  </style>
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
<?php



session_start();
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
  $get = $_SESSION['VIN'];
  $type = $_POST['Type'] ?? "";
  $color = $_POST['Color'] ?? "";
  $model = $_POST['Model'] ?? "";
  $year = $_POST['Year'] ?? "";
  $seats = $_POST['seats'] ?? "";
  $branch = $_POST['branch'] ?? "";
  $price = $_POST['price'] ?? "";
  $status = $_POST['status'] ?? "";
  if ($color != "") {
    $sql2 = "UPDATE car SET color= '$color' WHERE VIN='$get'";
    $mysqli->query($sql2);
  }
  if ($type != "") {
    $sql2 = "UPDATE car SET type= '$type' WHERE VIN='$get'";
    $mysqli->query($sql2);
  }

  if ($model != "") {
    $sql2 = "UPDATE car SET model= '$model' WHERE VIN='$get'";
    $mysqli->query($sql2);
  }
  if ($year != "") {
    $sql2 = "UPDATE car SET year= '$year' WHERE VIN='$get'";
    $mysqli->query($sql2);
  }
  if ($seats != "") {
    $sql2 = "UPDATE car SET seating_capacity= '$seats' WHERE VIN='$get'";
    $mysqli->query($sql2);
  }
  if ($branch != "") {
    $sql2 = "UPDATE car SET branch_id= '$branch' WHERE VIN='$get'";
    $mysqli->query($sql2);
  }
  if ($price != "") {
    $sql2 = "UPDATE car SET price_day= '$price' WHERE VIN='$get'";
    $mysqli->query($sql2);
  }
  if ($status != "") {
    $x=$get;
    $sql2 = "UPDATE car SET car_status= '$status' WHERE VIN='$get'";
    $sql3="update car set modification_date=CURDATE() where VIN='$get' ";
    $sql4="Insert into statuslog (VIN,modify_date,status) values('$x',CURDATE(), '$status')";
    $mysqli->query($sql2);
    $mysqli->query($sql3);
    $mysqli->query($sql4);
  }
  header("location:home.php");
}

$mysqli->close();

?>
<HTML>

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
    <h3 class="t">Car Specs</h3>

    <form method="POST">

      Color : <input type="text" name="Color" id="Color" placeholder="Enter Color">
      <br />
      <br />
      Type : <input type="text" name="Type" id="Type" placeholder="Enter TYPE">
      <br />
      <br />
      Model : <input type="text" name="Model" id="Model" placeholder="Enter Model">
      <br />
      <br />
      Year: <input type="text" name="Year" id="Year" placeholder="Enter Year">
      <br />
      <br />
      Seats : <input type="text" name="seats" id="seats" placeholder="Enter no of seats">
      <br />
      <br />
      Branch : <input type="text" name="branch" id="branch" placeholder="Enter Branch_id">
      <br />
      <br />
      Price : <input type="text" name="price" id="price" placeholder="Enter price">
      <br />
      <br />
      status : <input type="text" name="status" id="status" placeholder="Enter status">
      <br />
      <br />
      <input type="submit" class="sub" name="submit" value="Submit">
    </form>

  </div>
</body>

</html>