<html>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Car Reservations</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" />
	<link rel="stylesheet" href="tables.css">
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
			<h3 class="t">
				<h2> Reserved Cars</h2>
		</div>
		<div class="form-group">
			<div class="input-group">
				<span class="input-group-addon">Search</span>
				<input type="text" name="search_text" id="search_text" placeholder="Search by Car Details" class="form-control" />
			</div>
		</div>
		<br />
		<div id="result"></div>
	</div>
	<div style="clear:both"></div>
	<br />

	<br />
	<br />
	<br />
</body>

</html>


<script>
	$(document).ready(function() {
		load_data();

		function load_data(query) {
			$.ajax({
				url: "tagroba2.php",
				method: "post",
				data: {
					query: query
				},
				success: function(data) {
					$('#result').html(data);
				}
			});
		}

		$('#search_text').keyup(function() {
			var search = $(this).val();
			if (search != '') {
				load_data(search);
			} else {
				load_data();
			}
		});
	});
</script>