<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>VISA METHOD</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <style>
        table tr:not(:first-child) {
            cursor: pointer;
            transition: all .25s ease-in-out;
        }

        table tr:not(:first-child):hover {
            background-color: #ddd;
        }
    </style>
    <?php
    include("connection.php");
    session_start();
    $SSN = $_SESSION['SSN'];
    $VIN = $_SESSION['VIN'];
    // $sql2 = "SELECT max( payment_id ) FROM `payment` AS p, Reservation AS r WHERE  p.SSN = r.SSN and p.VIN = r.VIN and r.VIN ='$VIN' and r.SSN = '$SSN'";

    // $result2 = $mysqli->query($sql2);
    // if($result2): 

    //     if ($result2->num_rows > 0) : 
    //         $row1 = mysqli_fetch_assoc($result2);

    //      endif;
    //  endif;


    ?>

    <script>
        function formatc(ele, e) {
            if (ele.value.length < 16) {
                // ele.value= ele.value.replace(/\W/gi, '').replace(/(.{4})/g, '$1 ');
                return true;
            } else {
                return false;
            }
        }

        function formatcvv(ele, e) {
            if (ele.value.length < 3) {
                return true;
            } else {
                return false;
            }
        }

        function numberValidation(e) {
            e.target.value = e.target.value.replace(/[^\d ]/g, '');
            return false;
        }

        function validDate(date) {
            let currentDate = new Date();
            let cDay = currentDate.getDate();
            let cMonth = currentDate.getMonth() + 1;
            let cYear = currentDate.getFullYear();
            var time_c = document.getElementById("exptime").value;
            var split = time_c.split('/');
            var month = split[0];
            var day = split[1];
            var year = split[2];
            if (month != cMonth || day != cDay || year != cYear) {
                alert("This is an alert dialog box");
            }

        }

        function difference(date1, date2) {
            const date1utc = Date.UTC(date1.getFullYear(), date1.getMonth(), date1.getDate());
            const date2utc = Date.UTC(date2.getFullYear(), date2.getMonth(), date2.getDate());
            day = 1000 * 60 * 60 * 24;
            return (date2utc - date1utc) / day
        }

        function calculate_1() {
            var time_c = document.getElementById("pickup_date").value;
            var d1 = time_c.split("-");
            var dd_1 = new Date(d1[0], d1[1] - 1, d1[2]);
            var date2 = document.getElementById("return_time").value;
            var d2 = date2.split("-");
            var dd_2 = new Date(d2[0], d2[1] - 1, d2[2]);
            time_difference = difference(dd_1, dd_2);
            var num3 = document.getElementById("price_day").value;
            var result = time_difference * num3;
            // document.getElementById('total_price').innerHTML
            //     = result + " LE";
            return result;
        }

        function view_payment() {
            let dateObj = new Date();
            let month = String(dateObj.getMonth() + 1).padStart(2, '0');
            let day = String(dateObj.getDate()).padStart(2, '0');
            let year = dateObj.getFullYear();
            let output = month + '/' + day + '/' + year;
            // document.querySelector('.output').textContent = output;
            // id_counter ++;
            // var id_counter = parseInt(document.getElementById("pre").value) + 1;
            var amount_paid = calculate_1();
            // document.getElementById("payment_id").value = id_counter;
            document.getElementById("total_price").value = amount_paid;
            document.getElementById("payment_type").value = "visa";
            document.getElementById("payment_time").value = output;
        }

        function validateCIForm() {

            var cdno = document.forms["card_info"]["card_no"].value;
            var dateexp = document.forms["card_info"]["exp_date"].value;
            var cvv = document.forms["card_info"]["cvv"].value
            var nameoncard = document.forms["card_info"]["name_on_card"].value;

            var valid_date = dateexp.split("-");
            if (valid_date[0] < 2022 || valid_date[1] < 1 || valid_date[2] < 9) {
                alert("invalid exp date");
                return false;
            }
            if (cdno == null || cdno == "") {
                alert("card number must be filled out");
                return false;
            }

            if (dateexp == null || dateexp == "") {
                alert("exp_date must be filled out");

                return false;
            }

            if (cvv == null || cvv == "") {
                alert("CVV must be filled out");
                return false;
            }
            if (nameoncard == null || nameoncard == "") {
                alert("name on card must be filled out");
                return false;
            }
        }
    </script>

</head>

<body>

    <div class="container">
        <div class="panel-body">

            <?php

            $dbhost = 'localhost';
            $dbuser = 'root';
            $dbpass = '';
            $dbname = 'carrentalsystem';
            $mysqli = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
            if ($mysqli->connect_error) {
                die("Connectection failed " . $mysqli->connect_error);
            }

            $SSN = $_SESSION['SSN'];
            $VIN = $_SESSION['VIN'];

            $sql1 = "SELECT pickup_date, return_date, price_day FROM `Reservation` AS R, car AS C where C.VIN = R.VIN  and C.VIN = '$VIN' and R.SSN = '$SSN' ";

            $result1 = $mysqli->query($sql1);
            if ($result1) :

                if ($result1->num_rows > 0) : ?>
                    <?php while ($row = mysqli_fetch_assoc($result1)) : ?>
                        <label> Reservation pickup date:</label>
                        <input name="pickup_date" id="pickup_date" placeholder="test" value="<?php echo $row['pickup_date']; ?>" />
                        <label>END of reservation:</label>
                        <input name="return_time" id="return_time" placeholder="return_time" value="<?php echo $row['return_date']; ?>" />
                        <label>price of the car per day:</label>
                        <input name="price_day" id="price_day" placeholder="test" value="<?php echo $row['price_day']; ?>" />



                    <?php endwhile; ?>
                <?php endif; ?>
            <?php endif; ?>

            <!-- <label> Previous payment :</label>
                <input type="number" name="pre" id="pre"  placeholder="Previous payment" value = "<?php echo $row1["max( payment_id )"]; ?>"/> -->

            <br>
            <br>


        </div>

        <div class="page-header">
            <h1>Credit Card Payment Form</h1>
        </div>

        <!-- Credit Card Payment Form - START -->
        <div class="container">

            <div class="panel-heading">
                <h3 class="text-center">Payment Details</h3>
                <img class="img-responsive cc-img" src="http://www.prepbootstrap.com/Content/images/shared/misc/creditcardicons.png">
            </div>
            <div class="panel-body">

                <form id="card_info" name="card_info" action="payment.php" method="post">

                    <label>CARD NUMBER</label>
                    <input id="card_no" type="text" name="card_no" onkeypress='return formatc(this,event)' placeholder='Enter Credit Card No' />


                    <label><span class="hidden-xs">EXPIRATION</span><span class="visible-xs-inline">EXP</span> DATE</label>
                    <input name="exp_date" id="exp_date" type="date" onKeypress="validDate()" placeholder="MM / YY" />

                    <label>CVV CODE</label>
                    <input name="cvv" id="cvv" onkeypress='return formatcvv(this,event)' type="number" placeholder="CVV" />

                    <label>NAME ON CARD</label>
                    <input type="text" name="name_on_card" id="name_on_card" placeholder="Card Owner Names" />
                    <input type="submit" value="ADD" name="submit" onClick=" return validateCIForm()">
                    <input type="reset" value="RESET" onClick="window.location.reload()">

                </form>
            </div>
        </div>
        <!-- Credit Card Payment Form - END -->


        <!-- Display the user cards - START -->
        <div class="container">
            <h2 class="mb-5">USER CREDIT CARDS</h2>
            <?php
            $dbhost = 'localhost';
            $dbuser = 'root';
            $dbpass = '';
            $dbname = 'carrentalsystem';
            $mysqli = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
            if ($mysqli->connect_error) {
                die("Connectection failed " . $mysqli->connect_error);
            }
            $sql = "SELECT *  FROM `card` where SSN = $SSN ";
            $result = $mysqli->query($sql);
            if ($result) :

                if ($result->num_rows > 0) : ?>

                    <table id="table" border="1">
                        <tr>
                            <th> SSN </th>
                            <th> CVV </th>
                            <th> name_on_card </th>
                            <th> card_number </th>
                            <th> expiry_date </th>

                        <tr>

                            <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                        <tr>
                            <?php $test = $row['card_number']; ?>
                            <td><?php echo $row['SSN']; ?></td>
                            <td><?php echo $row['CVV']; ?></td>
                            <td><?php echo $row['name_on_card']; ?></td>
                            <td id="test"><?php echo preg_replace("/(?<=.{1}).(?=.{4})/", "*", $test); ?></td>
                            <td><?php echo $row['expiry_date']; ?></td>
                        </tr>
                    <?php endwhile; ?>
                    </table>
                    <br>
                    SELECTED CARD NUMBER:<input type="text" name="cno" id="cno"><br><br>
                    <script>
                        var table = document.getElementById('table');

                        for (var i = 1; i < table.rows.length; i++) {
                            table.rows[i].onclick = function() {
                                document.getElementById("cno").value = this.cells[3].innerHTML;
                            };
                        }
                    </script>
                <?php endif; ?>
            <?php endif; ?>
            <br>
            <button onclick="view_payment()">
                SHOW RESERVATION DETAILS BEFORE CONFIRMATION!
            </button>

        </div>
        <!-- view the payment details -->
        <div class="container">

            <div class="panel-heading">
                <h3 class="text-center">Payment REVIEW</h3>
            </div>
            <div class="panel-body">

                <form action="insert_pay.php" method="post">

                    <!-- <label>Payment ID</label>
                <input  id ="payment_id" type="number" name="payment_id"/>
                 -->

                    <label>amount paid</label>
                    <input name="total_price" id="total_price" type="number" placeholder="LE" />

                    <label>payment time</label>
                    <input name="payment_time" id="payment_time" type="text" placeholder="time" />

                    <label>payment type</label>
                    <input type="text" name="payment_type" id="payment_type" placeholder="Card Owner Names" />

                    <input type="submit" value="CONFIRM PAYMENT" name="submit">

                </form>
            </div>


        </div>
</body>

</html>