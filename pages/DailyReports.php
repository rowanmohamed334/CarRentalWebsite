<?php
session_start();
if (!isset($_SESSION["admin_name"])) {
    header("location: LoginPage.php");
} else
if ($_SESSION["admin_name"] != "1")
    header("location:homePage.php");
?>
<HTML>

<head>
    <title>
        Daily Reports
    </title>
    <meta name="viewport" content="width=device-width, user-scalable=no">
    <link rel="stylesheet" href="daily.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
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

    <div class="container" >
        <div>
            <form action="byDate.php" method='POST' style="margin-top: 150px;">
                <input type="submit" class="sub" name="byDate" value="View by date">
            </form>
            <form action="byUser.php" method="POST">
                <input type="submit" class="sub" name="byUser" value="View by User">
            </form>
            <form action="byCar.php" method="POST">
                <input type="submit" class="sub" name="byCar" value="View by car">
            </form>
            <form action="byPayment.php" method="POST">
                <input type="submit" class="sub" name="bypay" value="View by payment">
            </form>
            <form action="byStatus.php" method="POST">
                <input type="submit" class="sub" name="bystatus" value="View by status">
            </form>

        </div>
    </div>
</body>

</HTML>