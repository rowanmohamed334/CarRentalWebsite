<!DOCTYPE html>
<html>
<head>
        <meta charset="utf-8" />
        <title>VISA METHOD</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <?php
                include ("connection.php");
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
        function difference(date1, date2) {  
            const date1utc = Date.UTC(date1.getFullYear(), date1.getMonth(), date1.getDate());
            const date2utc = Date.UTC(date2.getFullYear(), date2.getMonth(), date2.getDate());
                day = 1000*60*60*24;
            return(date2utc - date1utc)/day
            }

            function calculate_1(){
                var time_c = document.getElementById("pickup_date").value;
                var d1 = time_c.split("-");
                var dd_1 = new Date(d1[0], d1[1] - 1, d1[2]);
                var date2 = document.getElementById("return_time").value;
                var d2 = date2.split("-");
                var dd_2 = new Date(d2[0], d2[1] - 1, d2[2]);
                time_difference = difference(dd_1,dd_2);
                var num3 = document.getElementById("price_day").value;
                var result = time_difference * num3;
                // document.getElementById('total_price').innerHTML
                //     = result + " LE";
                return result;
            }
        function view_payment(){
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
                document.getElementById("payment_type").value = "cash";
                document.getElementById("payment_time").value = output;
            }
    </script>
</head>
<body>

<div class="panel-body">
            
            <?php
                
                $dbhost = 'localhost';
                $dbuser = 'root';
                $dbpass = '';
                $dbname = 'carrentalsystem';
                $mysqli = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
                            if($mysqli->connect_error ) {
                            die("Connectection failed ". $mysqli->connect_error) ;
                            
                            }
                            
                $sql1 = "SELECT pickup_date, return_date, price_day FROM `Reservation` AS R, car AS C where C.VIN = R.VIN  and C.VIN = '$VIN' and R.SSN = '$SSN' ";

                
                $result1 = $mysqli->query($sql1);
            if($result1): 
                
                if ($result1->num_rows > 0) : ?>
                <?php  while($row = mysqli_fetch_assoc($result1)): ?>
                <label> Reservation pickup date:</label>
                <input  name="pickup_date" id="pickup_date"  placeholder="test" value = "<?php echo $row['pickup_date']; ?>"/>
                <label>END of reservation:</label>
                <input  name="return_time" id="return_time"  placeholder="return_time" value = "<?php echo $row['return_date']; ?>"/>
                <label>price of the car per day:</label>
                <input  name="price_day" id="price_day"  placeholder="test" value = "<?php echo $row['price_day']; ?>"/>
                
                
                
                <?php endwhile; ?>
                <?php endif;?>
                <?php endif;?>
<!-- 
                <label> Previous payment :</label>
                <input type="number" name="pre" id="pre"  placeholder="Previous payment" value = "<?php echo $row1["max( payment_id )"]; ?>"/> -->
            
            <br>
            <br>
    
            
        </div>


        <button onclick="view_payment()">
                SHOW RESERVATION DETAILS BEFORE CONFIRMATION!
        </button>

        <div class="container">

            <div class="panel-heading">
                <h3 class="text-center">Payment REVIEW</h3>
            </div>
            <div class="panel-body">

            <form  action="insert_pay.php" method="post">
<!--                 
                <label>Payment ID</label>
                <input  id ="payment_id" type="number" name="payment_id"/>
                 -->

                <label>amount paid</label>
                <input  name="total_price" id = "total_price" type="number" placeholder="LE" />

                <label>payment time</label>
                <input  name="payment_time" id="payment_time" type="text" placeholder="time"/>

                <label>payment type</label>
                <input type="text" name="payment_type" id="payment_type"   placeholder="Card Owner Names" />

                <input type="submit" value="CONFIRM PAYMENT" name="submit">
                
            </form>
            </div>
        
            
        </div>
</body>
</html>
