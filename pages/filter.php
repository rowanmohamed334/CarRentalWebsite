<?php
if (isset($_POST["filter"])) {

    session_start();
    $SSN = $_POST['SSN'] ?? "";
    $_SESSION['SSN'] = $SSN;
}
 {
    if ($_SESSION["admin_name"] == "1") {
        header("location:home.php");
        $_SESSION['admin_name'] = $_SESSION['admin_name'];
    }
}

?>
<!doctype html>
<!DOCTYPE HTML>
<html>

<head>
    <link rel="stylesheet" href="f.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <script>
        function validateForm() {


            let x = document.forms["search"]["pickup"].value;
            let today = new Date().toISOString().slice(0, 10)
            let y = document.forms["search"]["return"].value;
            if (x == "") {
                alert("Pick Up date must be filled out");
                return false;
            }

            if (y == "") {
                alert("Return date must be filled out");
                return false;
            }
            if(x<today)
        {
            alert("Invalid inputs : Pick up date !");
            return false;
        }

            if (x > y) {
                alert("Invalid inputs : Return date can't be after the Pick up date !");
                return false;
            }

        }

        function validateCar() {
            let z = document.forms["choose"]["VIN"].value;

            if (z == "") {
                alert("Please Choose a car ");
                return false;
            }
        }

        function navigateHome() {
            window.location.replace('homePage.php');
        }

        function logOut() {
            if (confirm("Are you sure you want to logout?"))
                window.location.replace('logout.php');
        }

        function navigateReserve() {
            window.location.replace('filter.php');
        }
    </script>
    <title>CAR RERSERAVATION FROUM</title>

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
    <div class="container">
        <div style="text-align: center;">
            <h2 class=" title t" style="margin-top: 100px;">PLEASE CHOOSE THE DESIRED CAR </h2>

            <div class="t1">
                <form name="search" action="filter.php" onsubmit="return validateForm()" method="POST">
                    <div>
                        <div>
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
                        <tr>
                            <td>PICK UP DATE:</td>
                            <td><input type="date" name="pickup"><br><br></td>
                            <td>RETURN DATE :</td>
                            <td><input type="date" name="return"><br><br></td>
                        </tr>
                    </div>
            </div>
            <div>
                <div class="t1">
                    <tr>
                        <td>CAR SEATING CAPACITY: </td>
                        <td><input type="radio" name="seating_capacity" value="7">7</td>
                        <td><input type="radio" name="seating_capacity" value="5">5<br><br></td>
                    </tr>
                </div>
            </div>
            <div>
                <div class="t1">
                    <tr>

                        <td>MAX PRICE:</td>
                        <td><input type="text" name="max_price"><br><br></td>
                        <td>MIN PRICE:</td>
                        <td><input type="text" name="min_price"><br><br></td>
                    </tr>
                </div>
            </div>
            <div class="t1">
                <div>
                    <tr>
                        <td>CAR TYPE:</td>
                        <td><input type="radio" name="type" value="automatic">Automatic</td>
                        <td><input type="radio" name="type" value="manual">Manual<br><br></td>
                    </tr>
                </div>
            </div>
            <div class="t1">
                <div>
                    <tr>
                        <td>CAR YAER:</td>
                        <td><input type="text" name="year"><br><br></td>
                    </tr>
                </div>
            </div>
            <div class="t1">
                <div>
                    <tr>
                        <td><input type="submit" class="sub" name="submit" value="browse"><br><br></td>
                    </tr>
                </div>
            </div>
            </form>
        </div>
        <div class="t1">
            <div class="table-wrapper-scroll-y my-custom-scrollbar">
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

                        include("db.php");
                        if (isset($_POST["submit"])) {


                            $location = $_POST['location'] ?? "";
                            $type = $_POST['type'] ?? "";
                            $color = $_POST['color'] ?? "";
                            $model = $_POST['model'] ?? "";
                            $seating_capacity = $_POST['seating_capacity'] ?? "";
                            $year = $_POST['year'] ?? "";
                            $max_price = $_POST['max_price'] ?? "";
                            $min_price = $_POST['min_price'] ?? "";
                            $pickup = $_POST['pickup'];
                            $return = $_POST['return'];



                            if (empty($color) && empty($model) && empty($location) && empty($year)  && empty($type)  && empty($seating_capacity)  && empty($max_price) && empty($min_price) && empty($pickup)) {
                                echo "empty";
                                $query = "SELECT *  FROM CAR JOIN AGENCYBRANCH ON AGENCYBRANCH.branch_id = CAR.branch_id WHERE CAR.car_status = 'active' 
                                INTERSECT 
                                (SELECT *  FROM CAR JOIN AGENCYBRANCH ON AGENCYBRANCH.branch_id = CAR.branch_id WHERE 
                                 CAR.VIN NOT IN ( SELECT VIN FROM RESERVATION WHERE return_date > '$pickup' AND pickup_date <'$return') ) ";

                                $data = mysqli_query($conn, $query) or die('error');
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
                                    echo "<script>alert('NO RECORDS FOUND');</script>";
                                }
                            } else {
                                $append = 0;

                                $query = "SELECT *  FROM CAR JOIN AGENCYBRANCH ON AGENCYBRANCH.branch_id = CAR.branch_id  ";
                                if (!empty($max_price)) {
                                    $query .= "WHERE price_day < '$max_price'";
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

                                $condition = " INTERSECT 
                            (SELECT *  FROM CAR JOIN AGENCYBRANCH ON AGENCYBRANCH.branch_id = CAR.branch_id WHERE
                            CAR.car_status = 'active' AND  
                            CAR.VIN NOT IN ( SELECT VIN FROM RESERVATION WHERE return_date > '$pickup' AND pickup_date <'$return')  )";
                                $query .= $condition;
                                // $q =" SELECT * FROM CAR JOIN AGENCYBRANCH on AGENCYBRANCH.branch_id = CAR.branch_id
                                //  WHERE VIN NOT IN ( SELECT VIN FROM RESERVATION WHERE return_date > '$pickup')";

                                $data = mysqli_query($conn, $query) or die('error');
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
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <script>
                var table = document.getElementById('table');
                for (var i = 0; i < table.rows.length; i++) {
                    table.rows[i].onclick = function() {
                        rIndex = this.rowIndex;
                        document.getElementById("VIN").value = this.cells[0].innerHTML;

                    };
                }
            </script>
            <form name="choose" action="reservation.php" onsubmit="return validateCar()" method="POST">
                <table id='reserve'>
                    <tr>
                        <td>CONFITMATION:</td>
                        <td>Reserved VIN:</td>
                        <td><input type="text" name="VIN" id="VIN" readonly></td>
                        <?php

                        ?>
                    </tr><br>

                    <tr>

                        <td>PICK UP DATE :</td>
                        <td><input type="date" name="p" value='<?php echo $pickup; ?>' readonly></td>
                        <td>RETURN DATE :</td>
                        <td><input type="date" name="r" value='<?php echo $return; ?>' readonly></td>
                    </tr>
                    <tr>
                        <td colspan="4"><input type="submit" value="Proceed To Payment" style="margin-top: 50px;" class="sub" name="submit"><br></td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
    </div>
</body>

</html>