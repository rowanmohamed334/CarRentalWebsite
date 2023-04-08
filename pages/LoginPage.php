<?php
session_start();
if (isset($_SESSION['admin_name'])) {
    if($_SESSION['admin_name']!='1')
        header("location:try.php");
    header("location: home.php");
}
if (isset($_SESSION['error']))
    if ($_SESSION['error'] == 1) {
        echo "<script>alert('Username or SSN already used')</script>";
        unset($_SESSION["error"]);
    }
?>
<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="styles.css">
    <title>Login</title>
    <script>
        function logIn() {
            var xuser = document.getElementById("lgInUsername").value;
            var xpass = document.getElementById("lgInPass").value;
            console.log(xvar);
            if (xuser == '' || xpass == '') {
                alert("Input must be filled out");
                return false;
            } else return true;
        }

        function signUp() {
            var xLname = document.getElementById("fName").value;
            var xFname = ocument.getElementById("lName").value;
            var xusername = document.getElementById("signUpUsername").value;
            var xpass1 = document.getElementById("pass1").value;
            var xpass2 = document.getElementById("pass2").value;
            var xssn = document.getElementById("ssn").value;
            var xemail = document.getElementById("email").value;
            var xphone = document.getElementById("phone").value;
            if (xFname == "" || xLname == "" || xemail == "" || xpass1 == "" || xpass2 == "" || xusername == "" || xFname == "" || xssn == "" || xphone == "") {
                alert("Input must be filled out");
                return false;
            }
            if (xpass1 != xpass2) {
                alert('Passwords do not match');
                return false;
            }
            if (/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(xemail) == false) {
                alert('Invalid email syntax');
                return false;
            } else
                return true;
        }

        function getMax() {

            return year + '-' + month + '-' + day;
        }
    </script>

</head>

<body class="background">
    <div class=" container">
        <div class=" row login ">
            <form class="loginForm form1" action="login.php" method='post' onsubmit="return logIn()">
                <h1 class="text-center ftitle">Login Form</h1>
                <label style="margin-right: 75px;">Username: </label>
                <input type="text" placeholder="Enter Username" style="text-align: center;" name='lgInUsername' id="lgInUsername"> <br><br>
                <label style="margin-right: 45px;">Enter password</label>
                <input type="password" placeholder="Enter Password" style="text-align: center;" name='lgInPass' id="lgInPass"> <br><br>
                <input type="submit" value="Login" class="subbtn" name="submit">
                <p class="hide text-center">Not Registered ? <a href="#">Register</a></p>
            </form>
        </div>
        <div class="row signup ">
            <form class="signupForm form1" action="regist.php" method='post' onsubmit="return signupvalidation()">
                <h1 class="text-center ftitle">Signup Form</h1>
                <label style="margin-right: 75px;">First Name: </label>
                <input type="text" placeholder="First Name" style="text-align: center;" name='fName' id="fName"><br><br>
                <label style="margin-right: 75px;">Last Name: </label>
                <input type="text" placeholder="Last Name" style="text-align: center;" name='lName' id="lName"><br><br>
                <label style="margin-right: 115px;">SSN: </label>
                <input type="text" placeholder="SSN" style="text-align: center;" name='ssn' id="ssn"><br><br>
                <label style="margin-right: 105px;">Email: </label>
                <input type="text" placeholder="Email" name='email' style="text-align: center;" id="email"><br><br>
                <label style="margin-right: 85px;">Username: </label>
                <input type="text" placeholder="Uswername" name='signUpUsername' style="text-align: center;" id="signUpUsername"><br><br>
                <label style="margin-right: 85px;">Password: </label>
                <input type="password" placeholder="Password" name='pass1' style="text-align: center;" id="pass1"><br><br>
                <label style="margin-right: 28px;">Confirm Password: </label>
                <input type="password" placeholder="Confirm Password" style="text-align: center;" name="pass2" id="pass2"><br><br>
                <label style="margin-right: 100px;"> Birthday: </label>
                <label style="margin-right: 20px;">
                    <input type="date" name="dob" id="dob" required>
                    <span class="validity"></span>
                </label><br><br>
                <label style="margin-right: 50px;">Phone Number: </label>
                <input type="text" placeholder="Phone Number" style="text-align: center;" name="phone" id="phone"><br><br>
                <input class="subbtn" type="submit" name="submit"><br><br>
                <div id="gotologin">
                    <p class="hide text-center">Already Registered ? <a href="#">login</a></p>
                </div>
            </form>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>
        $('.hide a').click(function() {
            $('.form1').animate({
                height: "toggle",
                opacity: "toggle"
            }, "slow");
        });
    </script>
</body>

</html>