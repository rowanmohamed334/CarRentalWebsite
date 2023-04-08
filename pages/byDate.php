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
            window.location.replace('indextest.php');
        }

        function navigateAdd() {
            window.location.replace('AddCars.php');
        }

        function navigateRes() {
            window.location.replace('indextest2.php');
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
            <h3 class="t">Reservations within specific date</h3><br><br>
        </div>
        <form method='POST' class="t1">
            <label style="margin-right: 200px;"> Enter search Start date: </label>
            <label style="margin-right: 20px;">
                <input type="date" name="start" value="<?php echo date('Y-m-d') ?>" id="start" required>
                <span class="validity"></span>
            </label><br><br>
            <label style="margin-right: 210px;"> Enter search end date: </label>
            <label style="margin-right: 20px;">
                <input type="date" name="end"  id="end">

            </label><br><br>
            <span><input type="submit" class="sub" name="back" value="Back" style=" margin-right:50px;"><input type="submit" class="sub" name="submit1" value="Go"></span>
        </form>
        <div class="tbl">
            <table id="b">
                <?php
                $dbhost = 'localhost';
                $dbuser = 'root';
                $dbpass = '';
                $dbname = 'carrentalsystem';
                $type = "";
                $result1 = "";
                $result2 = "";
                $mysqli = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
                if ($mysqli->connect_error) {
                    die("Connectection failed " . $mysqli->connect_error);
                } else
                if (isset($_POST['submit1'])) {
                    '<tr class="header">';
                    echo '<th> First Name </th>
                                    <th> Last Name </th>
                                    <th> SSN </th>
                                    <th> Phone </th>
                                    <th> Pickup date </th>
                                    <th> Return date </th>
                                    <th> Car VIN </th>
                                    <th> Car type </th>
                                    <th> Car color </th>
                                    <th> Car model </th>
                                    <th> Branch name </th>
                                    <th> Branch location </th>
                                    </tr>';
                    $start = $_POST['start'];
                    $end = $_POST['end'];
                    if (isset($start)) {
                        if ($end != "") {
                            if ($end < $start)
                                echo "<script>alert('Erorr! Start date is after end date.')</script>";
                            else {

                                $sql1 = "select SSN,Fname,Lname,phone,pickup_date,return_date,VIN,type,color,model,name,location 
                                from car natural join reservation natural join user NATURAL join agencybranch where pickup_date>=  '$start' and pickup_date <='$end'";
                                $result1 = $mysqli->query($sql1);
                                if ($result1)
                                    if ($result1->num_rows > 0) {
                                        while ($row = $result1->fetch_assoc()) { ?>
                                        <tr>
                                            <td> <?php echo $row['Fname'] ?></td>
                                            <td> <?php echo $row['Lname'] ?></td>
                                            <td> <?php echo $row['SSN'] ?></td>
                                            <td> <?php echo $row['phone'] ?></td>
                                            <td> <?php echo $row['pickup_date'] ?></td>
                                            <td> <?php echo $row['return_date'] ?></td>
                                            <td> <?php echo $row['VIN'] ?></td>
                                            <td> <?php echo $row['type'] ?></td>
                                            <td> <?php echo $row['color'] ?></td>
                                            <td> <?php echo $row['model'] ?></td>
                                            <td> <?php echo $row['name'] ?></td>
                                            <td> <?php echo $row['location'] ?></td>
                                        </tr>
                                    <?php  }
                                    } else if (!$result1) {
                                        echo "in else"; ?> <tr>
                                        <td colspan="12">No available reservation</td>
                                    </tr>
                                <?php }
                            }
                        } else {
                            $sql2 = "select SSN,Fname,Lname,phone,pickup_date,return_date,VIN,type,color,model,name,location 
                            from car natural join reservation natural join user NATURAL join agencybranch where pickup_date>= '$start'";;
                            $result2 = $mysqli->query($sql2);
                            if ($result2)
                                if ($result2->num_rows > 0) {
                                    while ($row = $result2->fetch_assoc()) { ?>
                                    <tr>
                                        <td> <?php echo $row['Fname'] ?></td>
                                        <td> <?php echo $row['Lname'] ?></td>
                                        <td> <?php echo $row['SSN'] ?></td>
                                        <td> <?php echo $row['phone'] ?></td>
                                        <td> <?php echo $row['pickup_date'] ?></td>
                                        <td> <?php echo $row['return_date'] ?></td>
                                        <td> <?php echo $row['VIN'] ?></td>
                                        <td> <?php echo $row['type'] ?></td>
                                        <td> <?php echo $row['color'] ?></td>
                                        <td> <?php echo $row['model'] ?></td>
                                        <td> <?php echo $row['name'] ?></td>
                                        <td> <?php echo $row['location'] ?></td>
                                    </tr>
                                <?php  }
                                } else { ?> <tr>
                                    <td colspan="12">No available reservation</td>
                                </tr> <?php }
                            }
                        }
                    }

                                        ?>
            </table>
        </div>
        <?php if (isset($_POST['back'])) {
            header("location: DailyReports.php");
        }
        $mysqli->close(); ?>
    </div>
</body>

</HTML>