<?php
require_once 'core.inc.php';

if (isset($_GET['data'])) {

    $data = $_GET['data'];

    if (!empty($data) ) {
        $query = "SELECT serial_no FROM appoint_number WHERE id=1";
        $query_run = mysqli_query($mysql_con, $query);
        while ($row = mysqli_fetch_assoc($query_run)) {
            $serial_no = $row['serial_no'];
        }
        $query = "SELECT previous_id FROM appointment WHERE serial_no='$serial_no'";
        $query_run = mysqli_query($mysql_con, $query);
        while ($row = mysqli_fetch_assoc($query_run)) {
            $previous_id = $row['previous_id'];
        }
    	$split_data = str_split($data,2);
        //print_r($split_data);
    	if($split_data[0]=="B:") {
            $bpm = substr($data, 2);
            if($bpm <= 40){
                $bpm = 0;

            }
            else{
                $bpm = substr($data, 2);
                $query = "UPDATE patient_table SET heartrate = '$bpm' WHERE patient_id='$previous_id'";
                $query_run = mysqli_query($mysql_con, $query);
                if($query_run){
                    echo 'done bpm<br/>';
                }
                echo "BPM: ".$bpm;
            }
            
    	}
    	else if($split_data[0]=="T:") {
            $temp = substr($data, 2);
            if($temp>0 && $temp<100){
                $query = "UPDATE patient_table SET temp = '$temp' WHERE patient_id='$previous_id'";
                $query_run = mysqli_query($mysql_con, $query);
                if($query_run){
                    echo 'done temp<br/>';
                }
                echo "Temperature: ".$temp;    
            }
            
    	}
    }   
}	
