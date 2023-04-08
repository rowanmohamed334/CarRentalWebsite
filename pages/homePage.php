<?php
session_start();
if (!isset($_SESSION["admin_name"])) {
    header("location: LoginPage.php");
} else{
         if ($_SESSION["admin_name"] == "1"){
            header("location:home.php");
            $_SESSION['admin_name']=$_SESSION['admin_name'];
        }

if (isset($_SESSION['error']))
    if ($_SESSION['error'] == 2) {
        echo "<script>alert('Signed Up successfully')</script>";
        unset($_SESSION["error"]);
    }
}
?>
<!DOCTYPE html>
<html>

<head>

    <link rel="stylesheet" href="1.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <title>Home page</title>
    <script>
        
        function navigateHome() {
            window.location.replace('homePage.php');
        }

        function logOut() {
            if (confirm("Are you sure you want to logout?"))
                window.location.replace('logout.php');
        }
        function navigateReserve(){
            window.location.replace('filter.php');
        }
        // function navigateCars() {
        //     window.location.replace('indextest.php');
        // }

        // function navigateAdd() {
        //     window.location.replace('AddCars.php');
        // }

        // function navigateRes() {
        //     //reservation page to be added
        // }

        // function navigateDaily() {
        //     window.location.replace('DailyReports.php');
        // }
    </script>
</head>

<body>
    <div class="top">
        <a href="#home" class="btn" onClick="navigateHome()">Home</a>
        <a href="#cars" class="btn" onClick="navigateReserve()">Reserve Cars</a>
        <!-- <a href="#reservations" class="btn" onClick="navigateRes()">View Reservations</a>
        <a href="#add" class="btn" onClick="navigateAdd()">Add new car</a>
        <a href="#DailyReports" class="btn" onClick="navigateDaily()">View daily reports</a> -->
        <a href="#logOut" class="btn out" onClick="logOut()">Logout</a>
    </div>
    <header class="header">
        <div class="txt">
            <?php echo "hi"; ?>
            <span>Car Rental System</span>
        </div>
        <p style="clear:bottom;">Text</p>
    </header>
    <div class="container">
        <div class="about">
            <div class="content">
                <h5 class="tag" style="max-width:1000px">
                    <span class="t"> About Us </span><br><br>
                    <div style="text-align: left;">
                        <p class="t1">We are an Egyptian based company, started our journey
                            JAN 2021 and now we are global wide. First our company was totally offline but since Jan 2022 we had our first interface with online world.
                            <br> Now you can use our system to reserve cars wherever you are. you can search for our car by its color, model, capacity or production year.Also you can view your reservations, edit them and cancel them without penalty!!. You can pay your reservation by cash or credit too.<br>
                            It's too easy, <a href="filter.php">Reserve now!</a>
                        </p>
                        <p class="t2">Our founders:</p>
                        <p class="t1" style=" margin-top:-15px;">Farhah Adel, Rodina Salah, Rowan Mohammed, Youssr Barakat</p>
                        <p class="t2">Our branches: </p><br>
                        <p class="t1" style=" margin-top:-30px;">
                            <?php
                            $conn = new mysqli("localhost", "root", "", "carrentalsystem");
                            if ($conn->connect_error) {
                                die("Connection failed: " . $conn->connect_error);
                            }
                            $sql = "SELECT name,location FROM agencybranch WHERE 1";
                            $result = $conn->query($sql);
                            if ($result->num_rows > 0) {
                                // output data of each row
                                while (!empty($result) && $row = $result->fetch_assoc()) {
                                    printf("%s &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp%s <br>", $row["name"], $row["location"]);
                                }
                            }
                            $conn->close();
                            ?></p>
                    </div>
                </h5>
            </div>
        </div>
        <div class="views">
            <span><img src="imgs/pic4.jpg" alt="First" class="pics" style="margin-right:50px;"></span> <span><img src="imgs/pic3.png" class="pics" alt="Variety" style="margin-left:50px;"></span>
            <p class="t1"><span style="float:left; margin-left: 450px"> First View our site</span><span style="float:right; margin-right: 520px">You will find many varieties</span> </p>
            <span><img src="imgs/pic2.jpg" alt="choose" class="pics" style="margin-right:50px;"></span><span><img src="imgs/pic1.png" alt="Start" class="pics" style="margin-left:50px;"></span>
            <p class="t1"><span style="float:left; margin-left: 410px"> Choose the most suitable one</span><span style="float:right; margin-right: 550px">Now you have a car!</span> </p>
        </div>
        <div class="end">

            <div>
</body>

</html>