<?php
require_once 'core.inc.php';

if (isset($_GET['id']) && isset($_GET['blood']) ) {

    $patient_id = $_GET['id'];
    $blood_group = $_GET['blood'];

    if (!empty($patient_id) && !empty($blood_group) ) {
    	$query = "UPDATE patient_table SET blood_group = '$blood_group' WHERE patient_id='$patient_id'";
        $query_run = mysqli_query($mysql_con, $query);
        if($query_run){
            echo 'done';
        }
    }   
}	
