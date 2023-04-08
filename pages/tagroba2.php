<?php
$connect = mysqli_connect("localhost", "root", "", "carrentalsystem");
$output = '';
if (isset($_POST["query"])) {
	$search = mysqli_real_escape_string($connect, $_POST["query"]);
	$query = "	
    SELECT *  FROM car NATURAL JOIN reservation JOIN user ON reservation.SSN=user.SSN WHERE 
	VIN LIKE '%" . $search . "%'
	OR type LIKE '%" . $search . "%' 
	OR color LIKE '%" . $search . "%' 
	OR model LIKE '%" . $search . "%' 
	OR seating_capacity LIKE '%" . $search . "%'
    OR price_day LIKE '%" . $search . "%'
    OR car_status LIKE '%" . $search . "%'
	OR user.SSN LIKE '%" . $search . "%'
	OR user.Fname LIKE '%" . $search . "%'
	OR user.Lname LIKE '%" . $search . "%'
    ";
} else {
	$query = "SELECT car.VIN,user.Fname,user.Lname,user.SSN,car.type,car.color,car.model,car.seating_capacity,car.price_day,car.car_status,reservation.booking_date,reservation.pickup_date,reservation.return_date FROM Reservation,car,user WHERE reservation.SSN=user.SSN and reservation.VIN=car.VIN Order by car.VIN ";
}
$result = mysqli_query($connect, $query);
if (mysqli_num_rows($result) > 0) {
	$output .= '<div class="table-responsive">
					<table class="table table bordered">
						<tr>
							<th>First Name</th>
							<th>Last Name </th>
							<th>SSN</th>
							<th>VIN</th>
							<th>Type</th>
							<th>Color</th>
							<th>Model</th>
							<th>Seats</th>
                            <th>price/day</th>
                            <th>Car Status</th>
                            <th>From Date</th>
                            <th>To Date</th>
						</tr>';
	while ($row = mysqli_fetch_array($result)) {
		$output .= '
			<tr>
				<td>' . $row['Fname'] . '</td>
				<td>' . $row['Lname'] . '</td>
				<td>' . $row['SSN'] . '</td>
				<td>' . $row["VIN"] . '</td>
				<td>' . $row["type"] . '</td>
				<td>' . $row["color"] . '</td>
				<td>' . $row["model"] . '</td>
				<td>' . $row["seating_capacity"] . '</td>
                <td>' . $row["price_day"] . '</td>
                <td>' . $row["car_status"] . '</td>
                <td>' . $row["pickup_date"] . '</td>
                <td>' . $row["return_date"] . '</td>

			</tr>
		';
	}
	echo $output;
} else {
	echo 'Data Not Found';
}
