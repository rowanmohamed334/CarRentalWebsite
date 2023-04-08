<html>

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
            <h3 class="t" style="margin-left:20px;">User reservations</h3><br><br>
            <form method="POST">
                <Label style="margin-right:270px">User</label><input type="text" id="user" name="user" placeholder="User" readonly><br><br>
                <span><input type="submit" id="re" class="sub" name="re" value="Another user" style="display: none; margin-left:670px; margin-bottom:50px;"> <input type="submit" id="btn" class="sub" name="submitBtn" value="View reservations"></span>
                <input type="submit" class="sub" name="back" value="Back" style=" margin-right:50px;">
            </form>

        </div>
        <div class="tbl" style="display:block;" id="table">
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
                } else {
                    $query = "select SSN,Fname,Lname,userid from user";
                    $result1 = $mysqli->query($query);
                    '<tr class="header">';
                    echo '<th> First Name </th>
                          <th> Last Name </th>
                          <th> SSN </th>
                    </tr>';
                    if ($result1)
                        if ($result1->num_rows > 0) {
                            while ($row = $result1->fetch_assoc()) {
                                if ($row['userid'] != 1) { ?>
                                <tr>
                                    <td> <?php echo $row['Fname'] ?></td>
                                    <td> <?php echo $row['Lname'] ?></td>
                                    <td> <?php echo $row['SSN'] ?></td>
                                </tr>
                <?php  }
                            }
                        }
                }


                ?>
            </table>
        </div>
        <script>
            var table = document.getElementById('table').getElementsByTagName('tr');
            console.log(table);
            for (var i = 0; i < table.length; i++) {
                table[i].onclick = function() {
                    rIndex = this.rowIndex;
                    document.getElementById("user").value = this.cells[2].innerHTML;

                };
            }
        </script>
        <div class="tbl" style="display:block;" id="table2">
            <table>
                <?php
                if (isset($_POST['submitBtn']))
                    if ($_POST['user'] == "")
                        echo "<script> alert('Please select user')</script>";
                    else {
                        $SSN = $_POST['user'];
                        echo "<script> document.getElementById('table').style.display= 'none';
                                document.getElementById('btn').style.display= 'none'
                                document.getElementById('re').style.display= 'block'
                                document.getElementById('user').value=$SSN;</script>";
                        $query2 = "select Fname,Lname,username,DOB,email,phone,VIN,model,pickup_date from car natural join reservation as r left join user as u on u.SSN=r.SSN where r.SSN='$SSN'";
                        $result2 = $mysqli->query($query2);
                        '<tr class="header">';
                        echo '<th> First Name </th>
                          <th> Last Name </th>
                          <th> Username </th>
                          <th> Email </th>
                          <th> Date of birth </th>
                          <th> Phone </th>
                          <th> Car plate id </th>
                          <th> Car model </th>
                          <th> Reservation date </th>
                        </tr>';
                        if ($result2)
                            if ($result2->num_rows > 0) {
                                while ($row = $result2->fetch_assoc()) {
                ?>
                            <tr>
                                <td> <?php echo $row['Fname'] ?></td>
                                <td> <?php echo $row['Lname'] ?></td>
                                <td> <?php echo $row['username'] ?></td>
                                <td> <?php echo $row['email'] ?></td>
                                <td> <?php echo $row['DOB'] ?></td>
                                <td> <?php echo $row['phone'] ?></td>
                                <td> <?php echo $row['VIN'] ?></td>
                                <td> <?php echo $row['model'] ?></td>
                                <td> <?php echo $row['pickup_date'] ?></td>
                            </tr>
                <?php
                                }
                            }
                           
                    }

                if (isset($_POST['back'])) {
                   echo'<script> window.location.replace("DailyReports.php") </script>';
                }
                $mysqli->close(); ?>
            </table>
        </div>
    </div>
</body>


</html>