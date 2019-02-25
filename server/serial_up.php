<?php
	require_once 'core.inc.php';
	$query = "SELECT * FROM appoint_number WHERE id=1";
	$query_run = mysqli_query($mysql_con, $query);
	while ($row = mysqli_fetch_assoc($query_run)) {
		$number = $row['serial_no'];
		$total_patient = $row['number'];
	}
	$query = "DELETE FROM appointment WHERE serial_no = '$number'";
    $query_run = mysqli_query($mysql_con, $query);
    if($number>=$total_patient) {
    	$query = "UPDATE appoint_number SET number = 0 WHERE id=1";
    	$query_run = mysqli_query($mysql_con, $query);
    	$number = -1;
    }
	$number = $number + 1;
	$query = "UPDATE appoint_number SET serial_no = '$number' WHERE id=1";
    $query_run = mysqli_query($mysql_con, $query);

    $query = "SELECT * FROM appointment WHERE serial_no='$number'";
	$query_run = mysqli_query($mysql_con, $query);
	$patient_id="";
	while ($row = mysqli_fetch_assoc($query_run)) {
	  	//var_dump($row);
		echo $patient_id = $row['previous_id'];
		
	}
?>