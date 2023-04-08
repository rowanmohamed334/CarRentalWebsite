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
        <div class="title">
            <h3 class="t" style="margin-left:20px;">Car reservations</h3><br><br>
            <form method="POST">
                <Label style="margin-right:270px">User</label><input type="text" id="car" name="car" placeholder="VIN" readonly><br><br>
                <span><input type="submit" id="re" class="sub" name="re" value="Another car" style="display: none; margin-left:670px; margin-bottom:50px;"> <input type="submit" id="btn" class="sub" name="submitBtn" value="View reservations"></span>
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
                    $query = "select VIN,type,model from car";
                    $result1 = $mysqli->query($query);
                    '<tr class="header">';
                    echo '<th> Model </th>
                          <th> Type </th>
                          <th> VIN </th>
                    </tr>';
                    if ($result1)
                        if ($result1->num_rows > 0) {
                            while ($row = $result1->fetch_assoc()) {
                ?>
                            <tr>
                                <td> <?php echo $row['model'] ?></td>
                                <td> <?php echo $row['type'] ?></td>
                                <td> <?php echo $row['VIN'] ?></td>
                            </tr>
                <?php  }
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
                    document.getElementById("car").value = this.cells[2].innerHTML;

                };
            }
        </script>
        <div class="tbl" style="display:block;" id="table2">
            <table>
                <?php
                if (isset($_POST['submitBtn']))
                    if ($_POST['car'] == "")
                        echo "<script> alert('Please select car')</script>";
                    else {
                        $VIN = $_POST['car'];
                        $VIN=str_replace(' ', '', $VIN);
                        echo "<script> document.getElementById('table').style.display= 'none';
                                document.getElementById('btn').style.display= 'none'
                                document.getElementById('re').style.display= 'block'
                                document.getElementById('car').value='$VIN';</script>";
                        $query2 = "select type,SSN,model,seating_capacity,year,location,return_date,pickup_date from car natural join reservation natural join agencybranch as b where VIN='$VIN'";
                        $result2 = $mysqli->query($query2);
                        '<tr class="header">';
                        echo '<th> model </th>
                          <th> type </th>
                          <th> seating capacity </th>
                          <th> year </th>
                          <th> SSN </th>
                          <th> location </th>
                          <th> pickup </th>
                          <th> return </th>
                        </tr>';
                        if ($result2)
                            if ($result2->num_rows > 0) {
                                while ($row = $result2->fetch_assoc()) {
                ?>
                            <tr>
                                <td> <?php echo $row['model'] ?></td>
                                <td> <?php echo $row['type'] ?></td>
                                <td> <?php echo $row['seating_capacity'] ?></td>
                                <td> <?php echo $row['year'] ?></td>
                                <td> <?php echo $row['SSN'] ?></td>
                                <td> <?php echo $row['location'] ?></td>
                                <td> <?php echo $row['pickup_date'] ?></td>
                                <td> <?php echo $row['return_date'] ?></td>
                              
                            </tr>
                <?php
                                }
                            } 
                    }
                    $mysqli->close(); 
                if (isset($_POST['back'])) 
                    echo'<script> location.replace("DailyReports.php"); </script>'; ?>
               
            </table>
        </div>
    </div>
</body>


</html>