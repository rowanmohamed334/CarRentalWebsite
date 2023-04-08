<?php
session_start();
if (!isset($_SESSION["admin_name"])) {
    header("location: LoginPage.php");
} else
if ($_SESSION["admin_name"] != "1")
    header("location:try.php");
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
        //document.getElementById('start').valueAsDate = new Date();
        // window.addEventListener('load', () => {
        //     const now = new Date();
        //     now.setMinutes(now.getMinutes() - now.getTimezoneOffset());
        //     document.getElementById('start').defaultValue = moment().locale().format('LTS');
        // });
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
        <div class="title">
            <h3 class="t">Payments within specific date</h3><br><br>
        </div>
        <form method='POST' class="t1">
            <label style="margin-right: 200px;"> Enter search Start date: </label>
            <label style="margin-right: 20px;">
                <input type="date" name="start" value="<?php echo date('Y-m-d') ?>" id="start" required>
                <span class="validity"></span>
            </label><br><br>
            <label style="margin-right: 210px;"> Enter search end date: </label>
            <label style="margin-right: 20px;">
                <input type="date" name="end" value="<?php echo date('Y-m-d') ?>" id="end">

            </label><br><br>
            <span><input type="submit" class="sub" name="back" value="Back" style=" margin-right:50px;"><input type="submit" class="sub" name="submit1" value="Go"></span>
        </form>
        <div class="tbl">
            <table>
                <?php
                $dbhost = 'localhost';
                $dbuser = 'root';
                $dbpass = '';
                $dbname = 'carrentalsystem';
                $count = 0;
                $result1 = "";
                $result2 = "";
                $mysqli = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
                if ($mysqli->connect_error) {
                    die("Connectection failed " . $mysqli->connect_error);
                } else
                if (isset($_POST['submit1'])) {
                    $start = $_POST['start'];
                    $end = $_POST['end'];
                    if (isset($start)) {
                        if ($end != "") {
                            if ($end < $start)
                                echo "<script>alert('Erorr! Start date is after end date.')</script>";
                            else {

                                $count = 0;
                                $i = $start;
                                while ($i <= $end) {
                                    $counter = 0;
                                    $sql1 = "select payment_type,pickup_date,booking_date as b, amount_paid from payment natural join reservation where  DATE(booking_date) =  '$i' or (pickup_date='$i' and payment_type='cash')";
                                    $result1 = $mysqli->query($sql1);
                                    if ($result1->num_rows > 0) {
                                        while ($row = $result1->fetch_assoc()) {
                                            $p = $row['pickup_date'];
                                            if ($row['payment_type'] == 'visa') {

                                                $counter = $counter + $row['amount_paid'];
                                                $count = $count + $row['amount_paid'];
                                            } else {
                                                if ($p <= $i) {

                                                    $counter = $counter + $row['amount_paid'];
                                                    $count = $count + $row['amount_paid'];
                                                }
                                            }
                                        }
                ?>
                                        <h2 class="t1"> Payment on<?php echo $i . "  =" . $counter; ?> </h2>
                                    <?php
                                    } else {
                                    ?> <h2 class="t1"> Payment on<?php echo $i . "  = 0"; ?> </h2>
                                <?php }
                                    $i = date('Y-m-d', strtotime($i . "+1 days"));
                                } ?>
                                <h2 class="t1"> Total payment from <?php echo $start ?> to <?php echo $end ?> = <?php echo $count ?></h2>
                <?php  }
                        }
                    } else {
                        echo '<script> alert("Please select end date") </script>';
                    }
                }

                ?>

                <?php if (isset($_POST['back'])) {
                    header("location: DailyReports.php");
                }
                $mysqli->close(); ?>
        </div>
</body>

</HTML>