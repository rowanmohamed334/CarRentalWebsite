<?php
session_start();

$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$dbname = 'carrentalsystem';
$mysqli = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
if ($mysqli->connect_error) {
    die("Connectection failed " . $mysqli->connect_error);
}


?>
<html>

<head>
    <link rel="stylesheet" href="fl.css">
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

    <form name="search" class="t1" style="margin-top:100px; text-align:center;" action="filteradmin.php" onsubmit="return validateForm()" method="POST">
        <div>
            <div>
                <div>
                    <tr>

                    </tr>
                </div>
            </div>
            <div>
                <tr>
                    <td>CURRENT LOCATION :</td>
                    <td><input type="text" name="location"><br><br></td>
                </tr>
            </div>
        </div>
        <div>
            <tr>
                <td>CAR MODEL:</td>
                <td><input type="text" name="model"><br><br></td>
            </tr>
        </div>
        </div>
        <div>
            <div>
                <tr>
                    <td>CAR COLOR:</td>
                    <td><input type="text" name="color"><br><br></td>
                </tr>
            </div>
        </div>
        <div>

        </div>
        </div>
        <div>
            <div>
                <tr>
                    <td>CAR SEATING CAPACITY:</td>
                    <td><input type="radio" name="seating_capacity" value="7">7</td>
                    <td><input type="radio" name="seating_capacity" value="5">5<br><br></td>
                </tr>
            </div>
        </div>
        <div>
            <div>
                <tr>

                    <td>MAX PRICE:</td>
                    <td><input type="text" name="max_price"><br><br></td>
                    <td>MIN PRICE:</td>
                    <td><input type="text" name="min_price"><br><br></td>
                </tr>
            </div>
        </div>
        <div>
            <div>
                <tr>
                    <td>CAR TYPE:</td>
                    <td><input type="radio" name="type" value="automatic">Automatic</td>
                    <td><input type="radio" name="type" value="manual">Manual<br><br></td>
                </tr>
            </div>
        </div>
        <div>
            <div>
                <tr>
                    <td>CAR YAER:</td>
                    <td><input type="text" name="year"><br><br></td>
                </tr>
            </div>
        </div>
        <div>
            <div>
                <tr>
                    <td><input type="submit" name="submit" class="sub" value="browse"><br><br></td>
                </tr>
            </div>
        </div>
    </form>

    <div>
        <div class="table-wrapper-scroll-y my-custom-scrollbar t1">
            <table class="table table-bordered table-striped mb-0" id="table" border="1">
                <thead>
                    <tr>

                        <th>VIN</th>
                        <th>Type</th>
                        <th>Color</th>
                        <th>Model</th>
                        <th>Year</th>
                        <th>Seating Capacity</th>
                        <th>Location</th>
                        <th>Price/day</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Session_start();
                    include("connection.php");
                    if (isset($_POST['submit_e'])) {

                        $VIN = $_POST["VIN"];
                        $_SESSION["VIN"] = $VIN;
                        echo $VIN;
                       echo' <script> window.location.replace("Editcars.php")</script>';
                    } ?>
                    <?php
                    if (isset($_POST["submit"])) {
                        $location = $_POST['location'] ?? "";
                        $type = $_POST['type'] ?? "";
                        $color = $_POST['color'] ?? "";
                        $model = $_POST['model'] ?? "";
                        $seating_capacity = $_POST['seating_capacity'] ?? "";
                        $year = $_POST['year'] ?? "";
                        $max_price = $_POST['max_price'] ?? "";
                        $min_price = $_POST['min_price'] ?? "";



                        if (empty($color) && empty($model) && empty($location) && empty($year)  && empty($type)  && empty($seating_capacity)  && empty($max_price) && empty($min_price)) {
                            $query = "SELECT *  FROM CAR JOIN AGENCYBRANCH ON AGENCYBRANCH.branch_id = CAR.branch_id";
                            $data = mysqli_query($mysqli, $query) or die('error');
                            if (mysqli_num_rows($data) > 0) {
                                while ($row = mysqli_fetch_array($data)) {
                                    $VIN = $row['VIN'];
                                    $type = $row['type'];
                                    $color = $row['color'];
                                    $model = $row['model'];
                                    $seating_capacity = $row['seating_capacity'];
                                    $location = $row['location'];
                                    $year = $row['year'];
                                    $price = $row['price_day'];
                    ?>

                                    <tr class="rows">
                                        <!-- <td><input type="radio" name="reserve" value =$VIN></td> -->
                                        <td><?php echo $VIN; ?></td>
                                        <td><?php echo $type; ?></td>
                                        <td><?php echo $color; ?></td>
                                        <td><?php echo $model; ?></td>
                                        <td><?php echo $year; ?></td>
                                        <td><?php echo $seating_capacity; ?></td>
                                        <td><?php echo $location; ?></td>
                                        <td><?php echo $price; ?></td>
                                    </tr>
                                <?php
                                }
                            } else {
                                echo "<script>alert('NO RECORDSffff FOUND');</script>";
                            }
                        } else {
                            $append = 0;

                            $query = "SELECT *  FROM car JOIN agencybranch ON agencybranch.branch_id = car.branch_id  ";

                            if (!empty($max_price)) {
                                $query .= "WHERE price_day < '$max_price'";
                                $append = 1;
                            }
                            if (!empty($VIN)) {
                                if ($append)
                                    $query .= " AND ";
                                else
                                    $query .= "WHERE ";
                                $query .= "VIN = '$VIN'";
                                $append = 1;
                            }
                            if (!empty($min_price)) {

                                if ($append)
                                    $query .= " AND ";
                                else
                                    $query .= "WHERE ";
                                $query .= "price_day > '$min_price'";
                                $append = 1;
                            }
                            if (!empty($color)) {
                                if ($append)
                                    $query .= " AND ";
                                else
                                    $query .= "WHERE ";
                                $query .= "color = '$color'";
                                $append = 1;
                            }
                            if (!empty($model)) {
                                if ($append)
                                    $query .= " AND ";
                                else
                                    $query .= "WHERE ";
                                $query .= "model = '$model'";
                                $append = 1;
                            }
                            if (!empty($location)) {
                                if ($append)
                                    $query .= " AND ";
                                else
                                    $query .= "WHERE ";
                                $query .= "location = '$location'";
                                $append = 1;
                            }
                            if (!empty($type)) {
                                if ($append)
                                    $query .= " AND ";
                                else
                                    $query .= "WHERE ";
                                $query .= "type = '$type'";
                                $append = 1;
                            }
                            if (!empty($year)) {
                                if ($append)
                                    $query .= " AND ";
                                else
                                    $query .= "WHERE ";
                                $query .= "year = '$year'";
                                $append = 1;
                            }
                            if (!empty($seating_capacity)) {
                                if ($append)
                                    $query .= " AND ";
                                else
                                    $query .= "WHERE ";
                                $query .= "seating_capacity = '$seating_capacity'";
                                $append = 1;
                            }


                            $data = mysqli_query($mysqli, $query) or die('error');
                            if (mysqli_num_rows($data) > 0) {
                                // echo "<script>alert('Noooo');</script>";
                                while ($row = mysqli_fetch_array($data)) {
                                    $VIN = $row['VIN'];
                                    $type = $row['type'];
                                    $color = $row['color'];
                                    $model = $row['model'];
                                    $seating_capacity = $row['seating_capacity'];
                                    $location = $row['location'];
                                    $year = $row['year'];
                                    $price = $row['price_day'];
                                ?>
                                    <tr class="rows">

                                        <td><?php echo $VIN; ?></td>
                                        <td><?php echo $type; ?></td>
                                        <td><?php echo $color; ?></td>
                                        <td><?php echo $model; ?></td>
                                        <td><?php echo $year; ?></td>
                                        <td><?php echo $seating_capacity; ?></td>
                                        <td><?php echo $location; ?></td>
                                        <td><?php echo $price; ?></td>
                                    </tr>


                    <?php

                                }
                            } else {
                                echo "<script>alert('NO RECORDS FOUND');</script>";
                            }
                        }
                    } ?>
                </tbody>
            </table>
        </div>
    </div> <?php
    ?>
    <script>
        var table = document.getElementById('table');
        for (var i = 0; i < table.rows.length; i++) {
            table.rows[i].onclick = function() {
                rIndex = this.rowIndex;
                document.getElementById("VIN").value = this.cells[0].innerHTML;

            };
        }
    </script>
    <form name="choose" onsubmit="return validateCar()" method="POST">
        <table id='reserve'>
            <tr>
                <td>CONFITMATION:</td>
                <td>SELECTED VIN:</td>
                <td><input type="text" name="VIN" id="VIN" readonly></td>
                <td><input type="submit" value="EDIT" class="sub" name="submit_e"></td>
                <?php

                ?>
            </tr>
        </table>
    </form>
    </div>
    </div>

</body>

</html>