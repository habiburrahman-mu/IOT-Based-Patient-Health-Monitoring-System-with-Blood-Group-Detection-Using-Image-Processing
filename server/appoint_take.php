<?php
require_once 'core.inc.php';

if (isset($_GET['submit']) && isset($_GET['name']) && isset($_GET['age']) && isset($_GET['sex']) && isset($_GET['previous_id']) ) {

    $name = $_GET['name'];
    $age = $_GET['age'];
    $sex = $_GET['sex'];
    $previous_id = $_GET['previous_id'];

    if (!empty($name) && !empty($age) && !empty($sex) ) {
    	if ($previous_id=="") {
    		$previous_id = "null"; 
    	}
        if($previous_id=="null") {
            //echo "in loop";

            $query = "SELECT number FROM patient_number WHERE id=1";
            $query_run = mysqli_query($mysql_con, $query);
            while ($row = mysqli_fetch_assoc($query_run)) {
                $patient_number = $row['number'];
            }
            $patient_number = $patient_number + 1;
            $query = "UPDATE patient_number SET number = '$patient_number' WHERE id=1;";
            $query_run = mysqli_query($mysql_con, $query);

            $patient_id = "TM".$patient_number;
            //echo $patient_id;
            $query = "INSERT INTO patient_table (patient_id, name, age, sex, blood_group, temp, heartrate) VALUES ('$patient_id', '$name', '$age', '$sex', 'n', 0, 0)";
            $query_run = mysqli_query($mysql_con, $query);

        }
        else {
            $patient_id = $previous_id;
        }
        $query = "SELECT number FROM appoint_number WHERE id=1";
        $query_run = mysqli_query($mysql_con, $query);
        while ($row = mysqli_fetch_assoc($query_run)) {
            $number = $row['number'];
        }
        $number = $number + 1;

        $query = "INSERT INTO appointment (serial_no, name, age, sex, previous_id) VALUES ('$number', '$name', '$age', '$sex', '$patient_id')";
        $query_run = mysqli_query($mysql_con, $query);
        if($query_run){
            
        }

        $query = "UPDATE appoint_number SET number = '$number' WHERE id=1";
        $query_run = mysqli_query($mysql_con, $query);
        if($query_run){
            
        }

        $msg = "Your appointment is successful. <br> Serial: " . $number. "<br>Patient Id: ".$patient_id;
        if($number>=1 && $number <=5){
        	$msg = $msg . "<br> Time: 7.00 PM";
        }
        elseif ($number>=6 && $number <=10) {
        	$msg = $msg . "<br> Time: 7.30 PM";
        }
        elseif ($number>=11 && $number <=15) {
        	$msg = $msg . "<br> Time: 8.00 PM";
        }
        elseif ($number>=16 && $number <=20) {
        	$msg = $msg . "<br> Time: 8.30 PM";
        }
        elseif ($number>=21 && $number <=25) {
        	$msg = $msg . "<br> Time: 9.00 PM";
        }
        elseif ($number>=26 && $number <=30) {
        	$msg = $msg . "<br> Time: 9.30 PM";
        }

        $msg = $msg . "<br>Please write down all data for future reference<br>";
    } else {
        $msg = "Please enter all data Correctly";
    }
}	
?>
<!doctype html>
<html lang="en">
	<head>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">

		<title>Appointment</title>
	</head>
	<body>
		<nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">
			<a class="navbar-brand" href="index.php">Dr. Ted Mosby's Office</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarNavAltMarkup">
				<div class="navbar-nav">
					<a class="nav-item nav-link active" href="index.php">Home <span class="sr-only">(current)</span></a>
					<a class="nav-item nav-link" href="appoint.php">Appointment</a>
				</div>	
			</div>
		</nav>
		<div class="container mb-4" style=" max-width: 600px; background-color:rgba(47, 42, 117, 0.02)">
		    <br>
		    <h3 class="lead mb-4" style="text-align: center"><?php echo $msg; ?></h3>
		</div>

		<!-- Optional JavaScript -->
		<!-- jQuery first, then Popper.js, then Bootstrap JS -->
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
		<script src="bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>